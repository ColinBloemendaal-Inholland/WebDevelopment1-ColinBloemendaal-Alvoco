<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository extends BaseRepository implements IBaseRepository
{
    public function filter(array $filters, ?int $start = null, ?int $limit = null): array
    {
        $query = Contact::query()->with('bestuurslid', 'bestuurslid.lid');
        if (isset($filters['naam'])) {
            $query->where('naam', 'like', '%' . $filters['naam'] . '%');
        }
        if (isset($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }
        if (!empty($filters['bestuurslid_id'])) {
            $query->where('bestuurslid_id', $filters['bestuurslid_id']);
        }

        if (isset($filters['trashed']) && $filters['trashed']) {
            $query->onlyTrashed();
        }

        $recordsTotal = $this->model->count();
        $recordsFiltered = $query->count();

        if (!is_null($start)) {
            $query->skip($start);
        }
        if (!is_null($limit)) {
            $query->take($limit);
        }

        $data = $query->get();
        return [
            'data' => $data,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
        ];
    }
}
