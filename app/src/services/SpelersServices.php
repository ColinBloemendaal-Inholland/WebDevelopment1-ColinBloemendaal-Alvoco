<?php 

namespace App\Services;

use App\Repositories\SpelersRepository;
use App\Models\Spelers;

class SpelersServices implements IServices {
    private SpelersRepository $repository;
    public function __construct() {
        $this->repository = new SpelersRepository(new Spelers());
    }

    public function get(int $id) {
        return $this->repository->get($id) ?? null;
    }
    public function getAll() {
        return $this->repository->getAll() ?? null;
    }
    public function create(array $data) {
        return $this->repository->create($data) ?? null;
    }
    public function update(int $id, array $data) {
        return $this->repository->update($id, $data) ?? null;
    }
    public function delete(int $id): bool {
        return $this->repository->delete($id) ?? false;
    }
    public function destroy(int $id): bool {
        return $this->repository->destroy($id) ?? false;
    }
    public function filter(array $filters, ?int $start = null, ?int $limit = null): array {
        //TODO: Make filter in the spelers repo
        return $this->repository->filter($filters, $start, $limit);
    }
}