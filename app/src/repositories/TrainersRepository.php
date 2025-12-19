<?php

namespace App\Repositories;

use App\Models\Trainers;
use Illuminate\Database\Eloquent\Collection;

class TrainersRepository extends BaseRepository
{
    public function __construct(Trainers $model)
    {
        parent::__construct($model);
    }
    /**
     * Get all coaches for a specific team
     */
    public function getByTeam(int $teamId): Collection
    {
        return $this->model->where('team_id', $teamId)->get();
    }

    /**
     * Get a coach by their member ID (Leden_id)
     */
    public function getByLidId(int $lidId): ?Trainers
    {
        return $this->model->where('Leden_id', $lidId)->first();
    }

    /**
     * Get all coaches by role (e.g., head, assistant)
     */
    public function getByRole(string $role): Collection
    {
        return $this->model->where('role', $role)->get();
    }

    public function getWithTeam(int $id): ?Trainers {
        return $this->model->with(['team','lid'])->find($id);
    }

    public function filter(array $filters, ?int $start = null, ?int $limit = null): array {
        $query = Trainers::query()->with('lid');

        if (!empty($filters['name'])) {
            $query->whereHas('lid', function ($q) use ($filters) {
                $q->where('firstname', 'like', '%' . $filters['name'] . '%')
                  ->orWhere('middlename', 'like', '%' . $filters['name'] . '%')
                  ->orWhere('lastname', 'like', '%' . $filters['name'] . '%');
            });
        }
        
        if(!empty($filters['role'])) {
            $query->where('role', 'like', '%' . $filters['role'] . '%');
        }

        $recordsTotal = Trainers::count();
        $recordsFiltered = $query->count();

        if (!is_null($start) && !is_null($limit)) {
            $query->skip($start)->take($limit);
        }

        $data = $query->get();

        return [
            'data' => $data,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
        ];
    }
}
