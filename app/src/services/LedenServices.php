<?php

namespace App\Services;

use App\Repositories\LedenRepository;
use App\Models\Leden;

class LedenServices implements IServices
{
    private LedenRepository $repository;
    public function __construct()
    {
        $this->repository = new LedenRepository(new Leden());
    }

    public function get(int $id, bool $roles = false) {
        $lid = $this->repository->get($id);
        $data = $lid;
        if($lid && $roles) {
            $data->roles = $lid->roles()->get()->toArray() ?? [];
            $data->roleIds = array_column($data->roles,'id') ?? [];
        }
        return $data ?? null;
    }
    public function getAll() {
        return $this->repository->getAll()->map([$this, 'format']) ?? null;
    }
    public function create(array $data) {
        return $this->repository->create($data) ?? null;
    }
    public function update(int $id, array $data, ?array $roles = null) {
        return $this->repository->update($id, $data, $roles) ?? null;
    }
    public function delete(int $id): bool {
        return $this->repository->delete($id) ?? false;
    }
    public function destroy(int $id): bool {
        return $this->repository->destroy($id) ?? false;
    }
    public function filter(array $filters, ?int $start = null, ?int $limit = null): array {
        return $this->repository->filter($filters, $start, $limit);
    }
    public function getByEmail(string $email)
    {
        return $this->repository->getByEmail($email);
    }
    public function datatable(array $filters, int $start, $length, int $draw): array
    {
        $result = $this->filter($filters, $start, $length);
        $formattedResults = array_map([$this, 'formatLid'], $result['data']->toArray());
        return [
            "draw" => $draw,
            "recordsTotal" => $result['recordsTotal'],
            "recordsFiltered" => $result['recordsFiltered'],
            "data" => $formattedResults,
        ];
    }

    public function format(Leden $row) {
        return [
            'id' => $row['id'],
            'fullname' => trim($row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']),
            'email' => $row['email'],
            'phone' => $row['phone'] ?? '',
            'adres' => trim(
                "{$row['streetname']} {$row['streetnumber']}, {$row['postalcode']} {$row['city']}"
            ),
        ];
    }

    protected function formatLid(array $row)
    {
        return [
            'fullname' => trim($row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']),
            'email' => $row['email'],
            'phone' => $row['phone'] ?? '',
            'adres' => trim(
                "{$row['streetname']} {$row['streetnumber']}, {$row['postalcode']} {$row['city']}"
            ),
            'id' => $row['id'],
        ];
    }

    public function getAllWithNoSpeler(?array $spelerIds = null) {
        return $this->repository->getAllWithNoSpeler($spelerIds)->map([$this, 'format']) ?? null;
    }
}
