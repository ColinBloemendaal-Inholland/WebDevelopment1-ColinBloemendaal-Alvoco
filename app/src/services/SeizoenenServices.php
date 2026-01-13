<?php

namespace App\Services;

use App\Repositories\SeizoenenRepository;
use App\Models\Seizoenen;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Database\Eloquent\Collection;

class SeizoenenServices implements IServices
{
    protected SeizoenenRepository $seizoenenRepository;

    public function __construct()
    {
        $this->seizoenenRepository = new SeizoenenRepository(new Seizoenen());
    }
    public function get(int $id, bool $relations = false)
    {
        return $this->seizoenenRepository->get($id);
    }
    public function getAll()
    {
        return $this->seizoenenRepository->getAll();
    }
    public function create(array $data)
    {
        return $this->seizoenenRepository->create($data);
    }
    public function update(int $id, array $data, ?array $relations = null)
    {
        return $this->seizoenenRepository->update($id, $data);
    }
    public function delete(int $id): bool
    {
        return $this->seizoenenRepository->delete($id);
    }
    public function destroy(int $id): bool
    {
        return $this->seizoenenRepository->destroy($id);
    }
    public function filter(array $filters, ?int $start = null, ?int $limit = null): array
    {
        return $this->seizoenenRepository->filter($filters, $start, $limit);
    }
    public function datatable(array $filters, int $start, $length, int $draw): array
    {
        $result = $this->filter($filters, $start, $length);
        return [
            "draw" => $draw,
            "recordsTotal" => $result['recordsTotal'],
            "recordsFiltered" => $result['recordsFiltered'],
            "data" => $result['data']->toArray(),
        ];
    }
}
