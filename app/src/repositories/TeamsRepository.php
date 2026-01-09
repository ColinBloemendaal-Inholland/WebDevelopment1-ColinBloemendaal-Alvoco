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
        $team = $this->model->find($id);
        if (!$team) {
            return null;
        }
        $spelers = isset($data['spelers']) && is_array($data['spelers']) ? $data['spelers'] : [];
        $coaches = isset($data['coaches']) && is_array($data['coaches']) ? $data['coaches'] : [];
        $trainers = isset($data['trainers']) && is_array($data['trainers']) ? $data['trainers'] : [];
        $team->update($data);
        Spelers::where('team_id', $team->id)
            ->update(['team_id' => null]);
        if (!empty($spelers)) {
            Spelers::whereIn('id', $spelers)
                ->update(['team_id' => $team->id]);
        }

        Coaches::where('team_id', $team->id)
            ->update(['team_id' => null]);
        if (!empty($coaches)) {
            Coaches::whereIn('id', $coaches)
                ->update(['team_id' => $team->id]);
        }

        Trainers::where('team_id', $team->id)
            ->update(['team_id' => null]);
        if (!empty($trainers)) {
            Trainers::whereIn('id', $trainers)
                ->update(['team_id' => $team->id]);
        }

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

    /**
     * Update trainers and spelers for a team (for coach edit)
     */
    public function updateTrainersAndSpelers(int $teamId, array $spelersIds, array $trainersIds)
    {
        $team = $this->model->find($teamId);
        if (!$team) {
            return null;
        }
        Spelers::where('team_id', $teamId)->update(['team_id' => null]);
        if (!empty($spelersIds)) {
            Spelers::whereIn('id', $spelersIds)->update(['team_id' => $teamId]);
        }
        Trainers::where('team_id', $teamId)->update(['team_id' => null]);
        if (!empty($trainersIds)) {
            Trainers::whereIn('id', $trainersIds)->update(['team_id' => $teamId]);
        }
        return $team->refresh();
    }

    public function getByCoachId(int $ledenId)
    {
        return $this->model::with(['spelers.lid', 'trainers.lid', 'coaches.lid'])->whereHas('coaches', function ($query) use ($ledenId) {
            $query->where('Leden_id', $ledenId);
        })->first();
    }
    
    public function getWithCoach(int $id)
    {
        return $this->model->with(['coaches', 'coaches.lid'])->where('id', $id)->first();
    }
}
