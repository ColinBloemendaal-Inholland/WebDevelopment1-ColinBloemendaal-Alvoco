<?php 

namespace App\Services;

use App\Repositories\RolesRepository;
use App\Models\Roles;

class RolenServices {
    private RolesRepository $repository;
    public function __construct() {
        $this->repository = new RolesRepository(new Roles());
    }
    public function getById(int $id)  {
        return $this->repository->get($id);
    }
    public function getByName(string $name) {
        return $this->repository->getByName($name);
    }
    public function getAll()  {
        return $this->repository->getAll();
    }
}