<?php

namespace Module\Project\src\Repositories;

use App\Repositories\BaseRepository;
use Module\Project\src\Models\Project;
use Module\Project\src\Repositories\ProjectRepositoryInterface;


class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    public function getModel()
    {
        return Project::class;
    }
}