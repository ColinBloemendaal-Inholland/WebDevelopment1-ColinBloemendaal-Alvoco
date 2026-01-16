<?php

namespace App\Repositories;

use App\Models\Bestuursleden;
use Illuminate\Database\Eloquent\Collection;

class BestuursledenRepository extends BaseRepository
{
    public function __construct(Bestuursleden $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all board members with a specific role
     */
    public function getByRole(string $role): Collection
    {
        return $this->model->where('role', $role)->get();
    }

    /**
     * Get board members by member ID (Leden_id)
     */
    public function getByLidId(int $lidId): ?Bestuursleden
    {
        return $this->model->where('Leden_id', $lidId)->first();
    }

    public function filter(array $filters, ?int $start = null, ?int $limit = null): array
    {
        $query = $this->model->newQuery();

        $recordsTotal = $this->model->count();
        $recordsFiltered = $query->count();

        // Apply filters
        if (!empty($filters['name'])) {
            $query->whereHas('lid', function ($q) use ($filters) {
                $q->where('firstname', 'like', $filters['name'] . '%')
                    ->orWhere('middlename', 'like', $filters['name'] . '%')
                    ->orWhere('lastname', 'like', $filters['name'] . '%');
            });
        }
        if (!empty($filters['role'])) {
            $query->where('role', 'like', '%' . $filters['role'] . '%');
        }
        if (!empty($filters['trashed']) && $filters['trashed'] == 1) {
            $query->onlyTrashed();
        }

        // Apply pagination
        if ($start !== null) {
            $query->skip($start);
        }
        if ($limit !== null) {
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
