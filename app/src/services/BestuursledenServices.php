<?php 

namespace App\Services;

use App\Repositories\BestuursledenRepository;
use App\Models\Bestuursleden;
use App\Services\LedenServices;

class BestuursledenServices implements IServices {
    private BestuursledenRepository $repository;
    private LedenServices $ledenServices;
    public function __construct() {
        $this->repository = new BestuursledenRepository(new Bestuursleden());
        $this->ledenServices = new LedenServices();
    }

    public function get(int $id){
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
        //TODO: Make filter in the bestuursleden repo
        return $this->repository->filter($filters, $start, $limit);
    }

    public function getAllWithNoCurrentBestuursleden() {
        $leden = $this->ledenServices->getAll();
        $bestuursleden = $this->getAll();
        return $leden->whereNotIn('id', $bestuursleden->pluck('Leden_id'));
    }
}
