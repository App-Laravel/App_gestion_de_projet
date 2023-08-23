<?php

namespace Modules\Task\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Task\src\Models\Task;
use Modules\Task\src\Repositories\TaskRepositoryInterface;


class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    public function getModel()
    {
        return Task::class;
    }
}