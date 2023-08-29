<?php

namespace Modules\Project\src\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
