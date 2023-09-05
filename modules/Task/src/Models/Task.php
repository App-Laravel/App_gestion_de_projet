<?php

namespace Modules\Task\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use Modules\Project\src\Models\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'tasks';

    public $fillable = ['title', 'status', 'priority', 'due_date', 'project_id', 'creator_id', 'comment'];


    // its many-to-many relation with Users via table pivot users_tasks
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'users_tasks',
            'task_id',
            'user_id'            
        )->withTimestamps();
    }


    // its one-to-many relation with User -> its creator
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            Post::class,
            'creator_id',
            'id'
        );
    }


    // its one-to-many relation with project
    public function project(): BelongsTo
    {
        return $this->belongsTo(
            Project::class,
            'project_id',
            'id'
        );
    }
}
