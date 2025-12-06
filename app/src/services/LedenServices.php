<?php 

namespace App\Services;

use App\Repositories\LedenRepository;
use App\Models\Leden;

class LedenServices {
    private LedenRepository $repository;
    public function __construct() {
        $this->repository = new LedenRepository(new Leden());
    }

    public function getByEmail(string $email) {
        return $this->repository->getByEmail($email);
    }
    public function getById(int $id)  {
        return $this->repository->getById($id);
    }
    public function getAll()  {
        return $this->repository->getAll();
    }
}