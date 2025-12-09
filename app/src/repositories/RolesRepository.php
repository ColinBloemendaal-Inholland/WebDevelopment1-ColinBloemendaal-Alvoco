<?php 

namespace App\Repositories;

use App\Models\Roles;

class RolesRepository extends BaseRepository
{
    public function __construct(Roles $model)
    {
        parent::__construct($model);
    }

    public function getByName(string $name): ?Roles {
        return $this->model->where("name", $name)->first();
    }
    
}