<?php
namespace App\Services;

use App\Models\Contact;
use App\Repositories\ContactRepository;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContactServices implements IServices {
    use SoftDeletes;
    private ContactRepository $repository;

    public function __construct()
    {
        $this->repository = new ContactRepository(new Contact());
    }

    public function verstuurContactFormulier(array $data)
    {
        return $this->repository->create($data);
    }
    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function get(int $id)
    {
        return $this->repository->get($id);
    }
    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
    public function destroy(int $id): bool
    {
        return $this->repository->destroy($id);
    }
    public function create(array $data)
    {
        return $this->repository->create($data);
    }
    public function datatable(array $filters, int $start, $length, int $draw): array
    {
        $result = $this->filter($filters, $start, $length);
        $formattedResults = array_map([$this, 'format'], $result['data']->toArray());
        return [
            "draw" => $draw,
            "recordsTotal" => $result['recordsTotal'],
            "recordsFiltered" => $result['recordsFiltered'],
            "data" => $formattedResults,
        ];
    }
    public function filter(array $filters, ?int $start = null, ?int $limit = null): array
    {
        return $this->repository->filter($filters, $start, $limit);
    }
    public function format(array $contact): array
    {
        return [
            'id' => $contact['id'],
            'naam' => $contact['naam'],
            'email' => $contact['email'],
            'bestuurslid' => isset($contact['bestuurslid']['lid']) ? $this->formatLidName($contact['bestuurslid']['lid']) : null,
            'deleted_at' => $contact['deleted_at'],
        ];
    }

    private function formatLidName(array $lid) {
        return $lid['firstname'] . ' '. ($lid['middlename'] ?? '') . ' ' . $lid['lastname'];
    }

}
