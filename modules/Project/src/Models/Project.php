<?php

namespace Modules\Project\src\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Task\src\Models\Task;

class Project extends Model
{
    use HasFactory;

    public $table = 'projects';

    public $fillable = ['name', 'priority', 'start_date', 'due_date', 'creator_id', 'comment'];

    public function users() {
        return $this->belongsToMany(
            User::class,
            'users_projects',
            'project_id',
            'user_id'            
        )->withTimestamps();
    }

    public function tasks() {
        return $this->hasMany(
            Task::class,
            'project_id',
            'id'          
        );
    }
}
