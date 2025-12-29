<?php 

namespace App\Services;

use App\Repositories\CoachesRepository;
use App\Models\Coaches;

class CoachesServices implements IServices {
    private CoachesRepository $repository;
    public function __construct() {
        $this->repository = new CoachesRepository(new Coaches());
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
        //TODO: Make filter in the coaches repo
        return $this->repository->filter($filters, $start, $limit);
    }
    public function getWithTeam(int $id) {
        return $this->repository->getWithTeam($id) ?? null;
    }
    public function datatable(array $filters, int $start, $length, int $draw): array
    {
        $result = $this->filter($filters, $start, $length);
        $formattedResults = $result['data']->map(function ($row) {
            return $this->format($row);
        })->toArray() ?? [];
        return [
            "draw" => $draw,
            "recordsTotal" => $result['recordsTotal'],
            "recordsFiltered" => $result['recordsFiltered'],
            "data" => $formattedResults,
        ];
    }
    public function format($row)
    {
        return [
            'id' => $row['id'],
            'name' => $row['lid']['fullname'],
            'role' => $row['role'],
        ];
    }
}
