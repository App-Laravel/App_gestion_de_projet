<?php

namespace Module\Task\src\Repositories;

use App\Repositories\BaseRepository;
use Module\Task\src\Models\Task;
use Module\Task\src\Repositories\TaskRepositoryInterface;


class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    public function getModel()
    {
        return Task::class;
    }
}