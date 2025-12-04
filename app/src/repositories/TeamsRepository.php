<?php

namespace App\Repositories;

use App\Models\Teams;
use Illuminate\Database\Eloquent\Collection;

class TeamsRepository extends BaseRepository
{
    public function __construct(Teams $model)
    {
        parent::__construct($model);
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
}
