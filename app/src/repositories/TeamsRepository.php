<?php

namespace App\Repositories;

use App\Models\Teams;
use App\Models\Spelers;
use App\Models\Coaches;
use App\Models\Trainers;
use Illuminate\Database\Eloquent\Collection;

class TeamsRepository extends BaseRepository
{
    public function createWithRelations(array $data): Teams
    {
        $team = $this->model->create($data);
        Spelers::whereIn('id', $data['spelers'] ?? [])
            ->update(['team_id' => $team->id]);

        Coaches::whereIn('id', $data['coaches'] ?? [])
            ->update(['team_id' => $team->id]);

        Trainers::whereIn('id', $data['trainers'] ?? [])
            ->update(['team_id' => $team->id]);
        return $team->refresh();
    }

    public function editWithRelations(int $id, array $data): ?Teams
    {
        $team = $this->get($id);
        if (!$team) {
            return null;
        }
        $team->update($data);

        Spelers::where('team_id', $team->id)
            ->update(['team_id' => null]);
        Spelers::whereIn('id', $data['spelers'] ?? [])
            ->update(['team_id' => $team->id]);

        Coaches::where('team_id', $team->id)
            ->update(['team_id' => null]);
        Coaches::whereIn('id', $data['coaches'] ?? [])
            ->update(['team_id' => $team->id]);

        Trainers::where('team_id', $team->id)
            ->update(['team_id' => null]);
        Trainers::whereIn('id', $data['trainers'] ?? [])
            ->update(['team_id' => $team->id]);

        return $team->refresh();
    }

    public function getTeamWithRelations(int $id): ?Teams
    {
        return $this->model->with(['spelers', 'coaches', 'trainers', 'wedstrijden'])->where('id', $id)->first();
    }

    public function getFullTeam(int $id)
    {
        return $this->model->with(['spelers', 'spelers.lid', 'coaches', 'coaches.lid', 'trainers', 'trainers.lid', 'wedstrijden', 'wedstrijden.hometeam', 'wedstrijden.awayteam'])->where('id', $id)->first();
    }

    /**
     * Get a team by its name
     */
    public function getByName(string $name): ?Teams
    {
        return $this->model->where('name', $name)->first();
    }

    /**
     * Get all teams in a specific category
     */
    public function getByCategory(string $category): Collection
    {
        return $this->model->where('Category', $category)->get();
    }

    /**
     * Get all players in a team
     */
    public function getPlayers(int $teamId): Collection
    {
        $team = $this->get($teamId);
        return $team ? $team->spelers : collect();
    }

    /**
     * Get all coaches in a team
     */
    public function getCoaches(int $teamId): Collection
    {
        $team = $this->get($teamId);
        return $team ? $team->coaches : collect();
    }

    /**
     * Get all trainers in a team
     */
    public function getTrainers(int $teamId): Collection
    {
        $team = $this->get($teamId);
        return $team ? $team->trainers : collect();
    }

    /**
     * Get all matches (Wedstrijden) for a team
     */
    public function getMatches(int $teamId): Collection
    {
        $team = $this->get($teamId);
        return $team ? $team->wedstrijden : collect();
    }

    public function filter(array $filters, ?int $start = null, ?int $limit = null): array
    {
        $query = Teams::query();
        $recordsTotal = Teams::count();
        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

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
