<?php

namespace Modules\Project\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Project\src\Models\Project;
use Modules\Project\src\Repositories\ProjectRepositoryInterface;


class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    public function getModel()
    {
        return Project::class;
    }
}