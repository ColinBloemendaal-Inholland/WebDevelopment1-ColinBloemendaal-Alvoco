<?php

namespace App\Services;

use App\Models\Nieuwsberichten;
use App\Repositories\NieuwsberichtenRepository;

class NieuwsberichtenServices implements IServices
{
    private NieuwsberichtenRepository $repository;
    public function __construct(?NieuwsberichtenRepository $nieuwsberichtenRepository = null)
    {
        $this->repository = $nieuwsberichtenRepository ?? new NieuwsberichtenRepository(new Nieuwsberichten());
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
        //TODO: Make filter in the nieuwsberichten repo
        return $this->repository->filter($filters, $start, $limit);
    }

    public function datatable(array $filters, int $start, int $length, int $draw)
    {
        $result = $this->filter($filters, $start, $length);
        $formattedResults = $result['data']->map(function ($row) { return $this->format($row);})->toArray();
        return [
            "draw" => $draw,
            "recordsTotal" => $result['recordsTotal'],
            "recordsFiltered" => $result['recordsFiltered'],
            "data" => $formattedResults,
        ];
    }

    public function format($row)
    {
        $leden = $row->Authur->lid ?? null;
        return [
            'fullname' => $leden ? trim($leden->firstname . ' ' . $leden->middlename . ' ' . $leden->lastname) : null,
            'title' => $row->Title,
            'id' => $row->id,
        ];
    }


}