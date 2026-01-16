<?php

namespace App\Repositories;

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

    public function filter(array $filters, ?int $start = null, ?int $limit = null): array
    {
        $query = $this->model->newQuery();

        $query->leftJoin('spelers_teams', 'Spelers.id', '=', 'spelers_teams.speler_id')
              ->leftJoin('Teams', 'spelers_teams.team_id', '=', 'Teams.id')
              ->leftJoin('Leden as lid', 'Spelers.Leden_id', '=', 'lid.id')
              ->select('lid.firstname', 'lid.middlename', 'lid.lastname', 'Teams.name as team_name', 'Spelers.*');

        if (!empty($filters['name'])) {
            $query->whereHas('lid', function ($q) use ($filters) {
                $q->where('fullname', 'LIKE', '%' . $filters['name'] . '%');
            });
        }

        if (!empty($filters['team'])) {
            $query->whereHas('teams', function ($q) use ($filters) {
                $q->where('id', '=', $filters['team']);
            });
        }

        $recordsTotal = $this->model->count();
        $recordsFiltered = $query->count();

        if (!is_null($start) && !is_null($limit)) {
            $query->skip($start)->take($limit);
        }

        if (isset($filters['trashed']) && $filters['trashed'] == 1) {
            $query->onlyTrashed();
        }

        $data = $query->get();

        return [
            'data' => $data,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
        ];
    }
}
