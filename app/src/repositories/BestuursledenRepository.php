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
}
