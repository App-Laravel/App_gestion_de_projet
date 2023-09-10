<?php
use App\Models\User;
use Modules\Task\src\Models\Task;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

// get task's total of authenticated user 
function getTasks() {
    $participatedTasks = User::find(Auth::user()->id)->tasks()->get();
    $createdTasks = Task::where('creator_id', Auth::user()->id)->get();
    $tasks = ($participatedTasks->concat($createdTasks))->unique();
    return $tasks;
}

// get recent tasks of authenticated user
function getRecentTasks($quantity) {
    return getTasks()->sortByDesc('created_at')->skip(0)->take($quantity)->all();
}

// get the status
function getStatus($status) {
    if ($status == 1) return 'To Do';
    if ($status == 2) return 'In Progress';
    if ($status == 3) return 'Done';
}

// get the status className
function getStatusClass($status) {
    if ($status == 1) return 'btn-primary';
    if ($status == 2) return 'btn-inprogress';
    if ($status == 3) return 'btn-success';
}

// get the coworkers of the task from the task's ID
function getTaskCoworkers($taskId) {
    return Task::find($taskId)->users()->whereNotNull('email_verified_at')->get();;
}

// check if the task exists ?
function checkTaskExistence($id=null) {
    if (checkInteger($id)) {
        $task = Task::find($id);
        if (!empty($task)) {
            return $task;
        }
    }
    return null;
}