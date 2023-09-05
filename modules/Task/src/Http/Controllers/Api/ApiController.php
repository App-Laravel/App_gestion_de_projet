<?php

namespace Modules\Task\src\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Project\src\Models\Project;


class ApiController extends Controller
{
    // api return the members of the selected project
    public function projectMembers(Request $request) {
        
        $projectID = $request->projectID;
        $users = Project::find($projectID)->users;
        
        $membersID = [];
        $membersName = [];

        if ($users->count() > 0) {
            foreach ($users as $user) {
                $membersID[] = $user->id;
                $membersName[] = $user->name;
            }
        }

        return [$membersID, $membersName];
    }
}