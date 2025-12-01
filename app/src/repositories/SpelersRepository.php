<?php

namespace App\src\Repositories;

use App\Models\Spelers;
use Illuminate\Database\Eloquent\Collection;

class SpelersRepository extends BaseRepository
{
    public function __construct(Spelers $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all players in a their team
     */
    public function getPlayersByTeam(int $teamId): Collection
    {
        return $this->model->where('team_id', $teamId)->get();
    }

    /**
     * Get a player by their member (Lid) id
     */
    public function getByLidId(int $lidId): ?Spelers
    {
        return $this->model->where('Leden_id', $lidId)->first();
    }
}
