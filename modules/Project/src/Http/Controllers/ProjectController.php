<?php

namespace Modules\Project\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Project\src\Models\Project;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\EmailRule;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // Show the user's list of all projects.
    public function index(Request $request)
    {   
        // get parameters
        $keyword = $request->keyword ?? '';
        $filter = $request->filter ?? 'created_at';

        // do query
        $participatedProjects = User::find(Auth::user()->id)->projects()->where('name', 'like', "%$keyword%")->get();
        $createdProjects = Project::where('creator_id', Auth::user()->id)->where(function($query) use($keyword) {
                $query->where('name', 'like', "%$keyword%");
                $query->orWhere('comment', 'like', "%$keyword%");
        })->get();
        $projects = ($participatedProjects->concat($createdProjects))->unique();

        // total of projects
        $total = $projects->count();

        // filter
        if ($filter == 'created_at' || $filter == 'due_date') {
            $projects = $projects->sortByDesc($filter);
        } else {
            $projects = $projects->sortBy($filter);
        }

        // pagination
        $perPage = 6;
        $page = $request->page ?? 1;
        $baseUrl = '/user/projects';
        $projects = $this->paginate($projects, $perPage, $page, $baseUrl);
       
        return view('Project::list', compact('projects', 'total'));
    }


    // show details of a project
    public function detail($id = null)
    {
        $project = checkProjectExistence($id);
        
        if (!empty($project)) {

            $todo = getProjectToDo($project);
            $inprogress = getProjectInProgress($project);
            $done = getProjectDone($project);

            $coworkers = $project->users;
            return view('Project::detail', compact('project', 'coworkers', 'todo', 'inprogress', 'done'));
        }

        abort(404);  
    }


    // view of add form
    public function add()
    {
        return view('Project::add');
    }

    // Handle of "Add new project"
    public function postAdd(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string', 'unique:projects,name'],
            'priority'  => ['required', 'integer', 'exists:projects,priority'],
            'startdate' => ['required', 'date'],
            'duedate'   => ['required', 'date']                   
        ]);
        
        $project = new Project();
        $status = $this->saveProject($request, $project);

        if (!empty($status)) {
            return redirect()->route('user.projects.index')->with('msg', trans('Project::messages.project-add-msg'));
        } else {
            return redirect()->route('user.projects.index')->with('msg-error', trans('Project::messages.project-add-msg-error'));
        }
    }


    // view of form for "Modify the project"
    public function edit($id = null)
    {
        $project = checkProjectExistence($id);
        if (!empty($project)) {
            $coworkers = $project->users;
            session(['id'=>$id]);
            return view('Project::edit', compact('project', 'coworkers'));
        }
        abort(404);        
    }


    // Handle the "Modify the project"
    public function postEdit(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string', 'unique:projects,name,'.session('id')],
            'priority'  => ['required', 'integer', 'exists:projects,priority'],
            'startdate' => ['required', 'date'],
            'duedate'   => ['required', 'date']         
        ]);
        
        $projectID = session('id');
        $project = checkProjectExistence($projectID);

        if (!empty($project)) {    
            
            $status = $this->saveProject($request, $project);

            if (!empty($status)) {
                return redirect()->route('user.projects.edit', ['id'=>$projectID])->with('msg', trans('Project::messages.project-edit-msg'));
            } else {
                return redirect()->route('user.projects.edit', ['id'=>$projectID])->with('msg-error', trans('Project::messages.project-edit-msg-error'));
            } 
        }
        abort(404);        
    }


    // Delete a project
    public function delete($id = null)
    {
        $project = checkProjectExistence($id);

        if (!empty($project)) {

            if ($project->creator_id == Auth::user()->id) {
                
                $projectTasks = $project->tasks;
                // delete all tasks of the project
                if ($projectTasks->count() > 0) {
                    foreach ($projectTasks as $projectTask) {
                        $projectTask->users()->detach();
                        $projectTask->delete();
                    }
                }
                
                $project->users()->detach();
                $status = $project->delete();
    
                if (!empty($status)) {
                    return redirect()->route('user.projects.index')->with('msg', trans('Project::messages.project-delete-msg'));
                } else {
                    return redirect()->route('user.projects.index')->with('msg-error', trans('Project::messages.project-delete-msg-error'));
                }
            } else {
                return back()->with('msg-error', trans('Project::messages.project-delete-owner-msg-error'));
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


    // get user ID from email
    public function getUserID (array $emails = []) : array
    {
        $userIDs = [];
        if (!empty($emails)) {
            foreach ($emails as $email) {
                if (!empty($email)) {
                    $userID = User::select('id')->where('email', $email)->first();
                    if (!empty($userID)) {
                        $userIDs[] = $userID->id;
                    }
                }
            }            
            $userIDs = array_unique($userIDs);
        }
        return $userIDs;
    }


    // save a project and coworkers
    public function saveProject($request, $project) {
        
        $emails = $request->email ?? []; 
        $coworkers = $this->getUserID($emails);
        
        $project->name = $request->name ?? 'Project Name ?';
        $project->priority = $request->priority ?? 1;
        $project->start_date = $request->startdate ?? now();
        $project->due_date = $request->duedate ?? now();
        
        if ($request->route()->uri == 'user/projects/add') {
            $project->creator_id = Auth::user()->id;
        }
        $project->comment = $request->comment ?? '';
        $status = $project->save();

        if ($request->route()->uri == 'user/projects/add') {
            // create ids on intermediate table
            $project->users()->attach($coworkers, ['created_at'=>now(), 'updated_at'=>now()]);
        } else {
            // update ids on intermediate table
            $project->users()->sync($coworkers);
        }
        
        return $status;
    }
}
