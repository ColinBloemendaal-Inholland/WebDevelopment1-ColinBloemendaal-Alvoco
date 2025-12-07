<?php

namespace App\Services;

use App\Repositories\LedenRepository;
use App\Models\Leden;

class LedenServices
{
    private LedenRepository $repository;
    public function __construct()
    {
        $this->repository = new LedenRepository(new Leden());
    }

    public function getByEmail(string $email)
    {
        return $this->repository->getByEmail($email);
    }
    public function getById(int $id): array
    {
        $lid = $this->repository->getById($id);

        if (!$lid) {
            throw new \Exception("Lid not found with ID $id");
        }

        $data = $lid->toArray();

        $data['roles'] = $lid->roles instanceof \Illuminate\Support\Collection
            ? $lid->roles->pluck('id')->toArray()
            : (is_array($lid->roles) ? $lid->roles : []);

        $data = array_map(fn($value) => $value === null ? '' : $value, $data);

        return $data;
    }
    public function getAll()
    {
        return $this->repository->getAll();
    }
    public function getLedenForDataTable(array $filters, int $start, $length, int $draw): array
    {
        $result = $this->repository->getFilterdLeden($filters, $start, $length);
        $formattedResults = array_map([$this, 'formatLid'], $result['data']->toArray());
        return [
            "draw" => $draw,
            "recordsTotal" => $result['recordsTotal'],
            "recordsFiltered" => $result['recordsFiltered'],
            "data" => $formattedResults,
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

    public function create(array $data)
    {
        return $this->repository->create($data);
    }
}