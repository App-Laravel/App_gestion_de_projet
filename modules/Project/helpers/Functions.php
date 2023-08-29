<?php
use App\Models\User;
use Modules\Project\src\Models\Project;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

function getCreatorName($id) {
    if ($id == Auth::user()->id) return 'You';
    return User::find($id)->name;
}

function getPriority($priority) {
    if ($priority == 1) return 'High';
    if ($priority == 2) return 'Medium';
    if ($priority == 3) return 'Low';
}

function getPriorityClass($priority) {
    if ($priority == 1) return 'btn-danger';
    if ($priority == 2) return 'btn-warning';
    if ($priority == 3) return 'btn-secondary';
}

function dateDisplay($date) {
    return Carbon::parse($date)->format('d/m/Y');
}

function getCoworkers($projectId) {
    return Project::find($projectId)->users;
}

function checkInteger($id) {
    $pattern = '/^[0-9]{1,}$/';
    return preg_match($pattern, $id);
}
function checkProjectExistence($id) {
    if (checkInteger($id)) {
        $project = Project::find($id);
        if (!empty($project)) {
            return $project;
        }
    }
    return null;
}
