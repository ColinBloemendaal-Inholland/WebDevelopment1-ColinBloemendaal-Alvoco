<?php

namespace App\Repositories;

use App\Models\Coaches;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class CoachesRepository extends BaseRepository
{
    public function __construct(Coaches $model)
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
    public function getByLidId(int $lidId): ?Coaches
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

    public function getWithTeam(int $id): ?Coaches {
        return $this->model->with(['team','lid'])->find($id);
    }
}
