<?php

namespace Modules\Task\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Task\src\Models\Task;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Models\User;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    // Show the user's list of all tasks.
    public function index(Request $request)
    {   
        
        // get parameters
        $keyword = $request->keyword ?? '';
        $filter = $request->filter ?? 'created_at';

        // do query
        $participatedTasks = User::find(Auth::user()->id)->tasks()->where('title', 'like', "%$keyword%")->get();
        $createdTasks = Task::where('creator_id', Auth::user()->id)->where(function($query) use($keyword) {
                $query->where('title', 'like', "%$keyword%");
                $query->orWhere('comment', 'like', "%$keyword%");
        })->get();
        $tasks = ($participatedTasks->concat($createdTasks))->unique();

        // total of tasks
        $total = $tasks->count();

        // filter. Task is Collection so sortByDesc, sortBy
        if ($filter == 'created_at' || $filter == 'due_date') {
            $tasks = $tasks->sortByDesc($filter);
        } else {
            $tasks = $tasks->sortBy($filter);
        }

        // pagination
        $perPage = 6;
        $page = $request->page ?? 1;
        $baseUrl = '/user/tasks';
        $tasks = $this->paginate($tasks, $perPage, $page, $baseUrl);
       
        return view('Task::list', compact('tasks', 'total'));
    }


    // show details of a project
    public function detail($id = null)
    {
        $task = checkTaskExistence($id);
        
        if (!empty($task)) {
            $coworkers = $task->users()->whereNotNull('email_verified_at')->get();

            return view('Task::detail', compact('task', 'coworkers'));
        }

        abort(404);        
    }


    // view of add form
    public function add()
    {
        return view('Task::add');
    }

    // Handle of "Add new task"
    public function postAdd(Request $request)
    {
        $request->validate([
            'title'     => ['required', 'string', 'unique:tasks,title'],
            'status'    => ['required', 'integer', 'exists:tasks,status'],
            'priority'  => ['required', 'integer', 'exists:tasks,priority'],
            'duedate'   => ['required', 'date']           
        ]);

        $task = new Task();
        $status = $this->saveTask($request, $task);

        if (!empty($status)) {
            return redirect()->route('user.tasks.index')->with('msg', trans('Task::messages.task-add-msg'));
        } else {
            return redirect()->route('user.tasks.index')->with('msg-error', trans('Task::messages.task-add-msg-error'));
        }
    }


    // view of form for "Modify the task"
    public function edit($id = null)
    {
        $task = checkTaskExistence($id);
        if (!empty($task)) {

            $coworkers = $task->users()->whereNotNull('email_verified_at')->get();

            session(['taskID'=>$id]);

            return view('Task::edit', compact('task', 'coworkers'));
        }
        abort(404);
    }


    // Handle the "Modify the project"
    public function postEdit(Request $request)
    {
        $request->validate([
            'title'     => ['required', 'string', 'unique:tasks,title,'.session('taskID')],
            'status'    => ['required', 'integer', 'exists:tasks,status'],
            'priority'  => ['required', 'integer', 'exists:tasks,priority'],
            'duedate'   => ['required', 'date']           
        ]);
        
        $taskID = session('taskID');
        $task = checkTaskExistence($taskID);

        if (!empty($task)) {    
            
            $status = $this->saveTask($request, $task);

            if (!empty($status)) {
                return redirect()->route('user.tasks.edit', ['id'=>$taskID])->with('msg', trans('Task::messages.task-edit-msg'));
            } else {
                return redirect()->route('user.tasks.edit', ['id'=>$taskID])->with('msg-error', trans('Task::messages.task-edit-msg-error'));
            } 
        }
        abort(404);
    }


    // Delete a project
    public function delete($id)
    {        
        $task = checkTaskExistence($id);

        if (!empty($task)) {

            if ($task->creator_id == Auth::user()->id) {
                
                $task->users()->detach();
                $status = $task->delete();
                
                if (!str_contains(request()->route()->uri, 'user/tasks/delete-in-project')) {
                    if (!empty($status)) {
                        return redirect()->route('user.tasks.index')->with('msg', trans('Task::messages.task-delete-msg'));
                    } else {
                        return redirect()->route('user.tasks.index')->with('msg-error', trans('Task::messages.task-delete-msg-error'));
                    }

                } else {
                    if (!empty($status)) {
                        return back()->with('msg', trans('Task::messages.task-delete-msg'));
                    } else {
                        return back()->with('msg-error', trans('Task::messages.task-delete-msg-error'));
                    }
                }
                
            } else {
                return back()->with('msg-error', trans('Task::messages.task-delete-owner-msg-error'));
            }              
        }
    }
    

    // Method "paginate" on a Collection
    public function paginate($items, $perPage = 8, $page = null, $baseUrl = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);
        
        $pagination = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

        if ($baseUrl) {
            $pagination->setPath($baseUrl);
        }

        return $pagination;
    }



    // Check member user ID
    public function checkUserIDs (array $memberIdArray = []) : array
    {
        $userIDs = [];
        if (!empty($memberIdArray)) {
            foreach ($memberIdArray as $id) {
                if (!empty(User::find($id))) {
                    $userIDs[] = $id;
                }            
            }
            $userIDs = array_unique($userIDs);
        }
        return $userIDs;
    }


    // save a project and coworkers
    public function saveTask($request, $task) {
        
        $memberIDs = $request->members ?? [];
        $checkedMemberIDs = $this->checkUserIDs($memberIDs);
        
        $task->title = $request->title ?? 'Task Name ?';
        $task->status = $request->status ?? 1;
        $task->priority = $request->priority ?? 1;
        $task->due_date = $request->duedate ?? now();
        
        $project = checkProjectExistence($request->project_id);
        if (!empty($project)) {
            $task->project_id = $project->id;
        } else {
            abort(404);
        }

        if ($request->route()->uri == 'user/tasks/add') {
            $task->creator_id = Auth::user()->id;
        }
        
        $task->comment = $request->comment ?? '';
        $status = $task->save();

        if ($request->route()->uri == 'user/tasks/add') {
            // create Ids on intermediate table
            $task->users()->attach($checkedMemberIDs, ['created_at'=>now(), 'updated_at'=>now()]);
        } else {
            // update Ids on intermediate table
            $task->users()->sync($checkedMemberIDs);
        }
        
        return $status;
    }

}
