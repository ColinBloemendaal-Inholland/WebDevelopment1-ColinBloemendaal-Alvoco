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

    public function get(int $id): array {
        $lid = $this->repository->get($id);
        return 
    }
    public function getAll(): array {

    }
    public function create(array $data): array {

    }
    public function update(int $id, array $data): array {

    }
    public function delete(int $id): array {

    }
    public function destroy(int $id): array {

    }
    public function datatables(array $filters, int $start, int $length, int $draw): array {

    }
    public function format(array $data): array {

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

        $data['roles'] = $lid->roles()->get()->toArray();
        $data['roleIds'] = array_column($data['roles'],'id');

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

    public function update(int $id, array $data, array $roles)
    {
        $lid = $this->repository->getById($id);
        $lid->update($data);
        $lid->roles()->sync($roles);
        return $lid;
    }
}