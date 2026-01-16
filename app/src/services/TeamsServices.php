<?php

namespace App\Services;

use App\Repositories\TeamsRepository;
use App\Models\Teams;

class TeamsServices implements IServices
{
    private TeamsRepository $repository;
    public function __construct()
    {
        $this->repository = new TeamsRepository(new Teams());
    }

    public function get(int $id)
    {
        return $this->repository->get($id) ?? null;
    }
    public function getAll()
    {
        return $this->repository->getAll() ?? null;
    }
    public function create(array $data)
    {
        return $this->repository->createWithRelations($data);
    }
    public function update(int $id, array $data)
    {
        return $this->repository->editWithRelations($id, $data) ?? null;
    }
    public function delete(int $id): bool
    {
        return $this->repository->delete($id) ?? false;
    }
    public function destroy(int $id): bool
    {
        return $this->repository->destroy($id) ?? false;
    }
    public function filter(array $filters, ?int $start = null, ?int $limit = null): array
    {
        return $this->repository->filter($filters, $start, $limit);
    }
    public function datatable(array $filters, int $start, $length, int $draw): array
    {
        $result = $this->filter($filters, $start, $length);
        $formattedResults = array_map([$this, 'format'], $result['data']->toArray() ?? []);
        return [
            "draw" => $draw,
            "recordsTotal" => $result['recordsTotal'],
            "recordsFiltered" => $result['recordsFiltered'],
            "data" => $formattedResults,
        ];
    }
    public function format(array $row)
    {
        return [
            'id' => $row['id'],
            'name' => $row['name'],
            'class' => $row['class'],
            'seizoen' => $row['seizoenen']['title'] ?? 'Onbekend',
            'deleted_at' => $row['deleted_at'],
        ];
    }

    public function getAllByCategory($season = null)
    {
        $teams = $this->repository->getAllBySeason($season);

        $groupedTeams = [];
        $groupedTeams['Heren'] = [];
        $groupedTeams['Dames'] = [];
        $groupedTeams['Jongens'] = [];
        $groupedTeams['Meiden'] = [];
        $groupedTeams['Overig'] = [];

        foreach ($teams as $team) {
            $team->image = $this->getTeamImage($team);
            $cat = $team->category ?? 'Overig';
            $cat = ucfirst(strtolower($cat));
            if (!isset($groupedTeams[$cat])) {
                $groupedTeams[$cat] = [];
            }
            $groupedTeams[$cat][] = $team;
        }
        return $groupedTeams;
    }

    public function getTeamWithRelations(int $id)
    {
        $team = $this->repository->getTeamWithRelations($id) ?? null;
        if ($team) {
            $team->image = $this->getTeamImage($team);
        }
        return $team;
    }

    /**
     * Returns the web path to the team image or a fallback if not found
     */
    public function getTeamImage($team)
    {
        $imageFile = $team->picture ?? null;
        $publicPath = ROOT . '/public/uploads/teams/';
        $webPath = '/uploads/teams/';
        if ($imageFile && file_exists($publicPath . $imageFile)) {
            return $webPath . $imageFile;
        }
        return null;
    }

    /**
     * Update trainers and spelers for a team (for coach edit)
     */
    public function updateTrainersAndSpelers(int $teamId, array $spelersIds, array $trainersIds)
    {
        return $this->repository->updateTrainersAndSpelers($teamId, $spelersIds, $trainersIds);
    }

    public function getByCoach(int $ledenId)
    {
        return $this->repository->getByCoachId($ledenId);
    }

    public function getWithCoach(int $id)
    {
        return $this->repository->getWithCoach($id);
    }
}
