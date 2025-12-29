<?php 

namespace App\Services;

use App\Repositories\RolesRepository;
use App\Models\Roles;

class RolesServices implements IServices {
    private RolesRepository $repository;
    public function __construct() {
        $this->repository = new RolesRepository(new Roles());
    }

    public function get(int $id): array {
        return $this->repository->get($id)->toArray() ?? null;
    }
    public function getAll() {
        return $this->repository->getAll() ?? null;
    }
    public function create(array $data): array {
        return $this->repository->create($data)->toArray() ?? null;
    }
    public function update(int $id, array $data): array {
        return $this->repository->update($id, $data)->toArray() ?? null;
    }
    public function delete(int $id): bool {
        return $this->repository->delete($id) ?? false;
    }
    public function destroy(int $id): bool {
        return $this->repository->destroy($id) ?? false;
    }
    public function filter(array $filters, ?int $start = null, ?int $limit = null): array {
        //TODO: Make filter in the roles repo
        return $this->repository->filter($filters, $start, $limit);
    }
    public function getByName(string $name) {
        return $this->repository->getByName($name);
    }
}
