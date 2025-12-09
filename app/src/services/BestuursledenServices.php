<?php 

namespace App\Services;

use App\Repositories\BestuursledenRepository;
use App\Models\Bestuursleden;

class BestuursledenServices implements IServices {
    private BestuursledenRepository $repository;
    public function __construct() {
        $this->repository = new BestuursledenRepository(new Bestuursleden());
    }

    public function get(int $id): array {
        return $this->repository->get($id)->toArray() ?? null;
    }
    public function getAll(): array {
        return $this->repository->getAll()->toArray() ?? null;
    }
    public function create(array $data): array {
        return $this->repository->create($data)->toArray() ?? null;
    }
    public function update(int $id, array $data, ?array $roles = null): array {
        return $this->repository->update($id, $data, $roles)->toArray() ?? null;
    }
    public function delete(int $id): bool {
        return $this->repository->delete($id) ?? false;
    }
    public function destroy(int $id): bool {
        return $this->repository->destroy($id) ?? false;
    }
    public function filter(array $filters, ?int $start = null, ?int $limit = null): array {
        //TODO: Make filter in the bestuursleden repo
        return $this->repository->filter($filters, $start, $limit);
    }
}