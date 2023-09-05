<?php
use App\Models\User;
use Modules\Project\src\Models\Project;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

// get project's total of authenticated user 
function getProjects() {
    $participatedProjects = User::find(Auth::user()->id)->projects()->get();
    $createdProjects = Project::where('creator_id', Auth::user()->id)->get();
    $projects = ($participatedProjects->concat($createdProjects))->unique();
    return $projects;
}

// get project's task "TODO" 
function getProjectToDo($project = null) {
    if (!empty($project)) {
        return ($project->tasks()->where('status', 1)->get());
    }
    return null;
}

// get project's task "IN PROGRESS" 
function getProjectInProgress($project = null) {
    if (!empty($project)) {
        return ($project->tasks()->where('status', 2)->get());
    }
    return null;
}

// get project's task "DONE" 
function getProjectDone($project = null) {
    if (!empty($project)) {
        return ($project->tasks()->where('status', 3)->get());
    }
    return null;
}

// get project's advancement 
function getProjectsAdvancement($project = null) {
    if (!empty($project)) {
        $total = $project->tasks()->get();
        if ($total->count() > 0) {
            $inprogess = getProjectInProgress($project);
            $done = getProjectDone($project);
            $advancement = (($inprogess->count())*0.5 + ($done->count())*1 )/($total->count());
            return round($advancement, 2)*100;
        }       
    }
    return 0;
}

// get the name of the project'S creator
function getCreatorName($id) {
    if ($id == Auth::user()->id) return 'You';
    return ucwords(User::find($id)->name);
}

// get the priority
function getPriority($priority) {
    if ($priority == 1) return 'High';
    if ($priority == 2) return 'Medium';
    if ($priority == 3) return 'Low';
}

// get the priority className
function getPriorityClass($priority) {
    if ($priority == 1) return 'btn-danger';
    if ($priority == 2) return 'btn-warning';
    if ($priority == 3) return 'btn-secondary';
}

// display the date under the format day/month/year
function dateDisplay($date) {
    return Carbon::parse($date)->format('d/m/Y');
}

// get the coworkers of the project from the project's ID
function getCoworkers($projectId) {
    return Project::find($projectId)->users;
}

// check if it is integer
function checkInteger($id=null) {
    $pattern = '/^[0-9]{1,}$/';
    return preg_match($pattern, $id);
}

// check if the project exists ?
function checkProjectExistence($id=null) {
    if (checkInteger($id)) {
        $project = Project::find($id);
        if (!empty($project)) {
            return $project;
        }
    }
    return null;
}