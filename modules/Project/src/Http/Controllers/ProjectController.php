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
use Illuminate\Support\Arr;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $createdProjects = Project::where('creator_id', Auth::user()->id)->where('name', 'like', "%$keyword%")->get();
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


    // detail of a project
    public function detail($id = null)
    {
        return view('Project::detail');
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
            'name'      => ['required', 'string'],
            'priority'  => ['required', 'integer', 'exists:projects'],
            'startdate' => ['required', 'date'],
            'duedate'   => ['required', 'date']            
        ]);
        
        $project = new Project();
        $status = $this->saveProject($request, $project);

        if ($status) {
            return redirect()->route('user.projects.index')->with('msg', 'The project has been successfully created.');
        } else {
            return redirect()->route('user.projects.index')->with('msg-error', 'The project could not be created. Please try again later.');
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
        return view('client.home');        
    }


    // Handle the "Modify the project"
    public function postEdit(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string'],
            'priority'  => ['required', 'integer', 'exists:projects'],
            'startdate' => ['required', 'date'],
            'duedate'   => ['required', 'date']            
        ]);
        
        $projectID = session('id');
        $project = checkProjectExistence($projectID);

        if (!empty($project)) {    
            
            $status = $this->saveProject($request, $project);

            if ($status) {
                return back()->with('msg', 'The project has been successfully updated.');
            } else {
                return back()->with('msg-error', 'The project could not be updated. Please try again later.');
            } 
        }
        return view('client.home');        
    }


    // Delete a project
    public function delete($id)
    {
        $project = checkProjectExistence($id);

        if (!empty($project)) {
            $project->users()->detach();
            $status = $project->delete();

            if ($status) {
                return redirect()->route('user.projects.index')->with('msg', 'The project has been deleted.');
            } else {
                return redirect()->route('user.projects.index')->with('msg-error', 'The project could not be deleted. Please try again later.');
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
    public function getUserID (array $emails) : array
    {
        $userIDs = [];
        if (!empty($emails)) {
            foreach ($emails as $email) {
                $userID = User::select('id')->where('email', $email)->first();
                if (!empty($userID)) {
                    $userIDs[] = $userID->id;
                }
            }
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
            $project->users()->attach($coworkers, ['created_at'=>now(), 'updated_at'=>now()]);
        } else {
            // update ids on intermediate table
            $project->users()->sync($coworkers);
        }
        
        return $status;
    }
}
