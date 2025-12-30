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
        //TODO: Make filter in the bestuursleden repo
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
        ];
    }

    public function getAllByCategory() {
        $teams = $this->getAll();

        $groupedTeams = [];
        $groupedTeams['Heren'] = [];
        $groupedTeams['Dames'] = [];
        $groupedTeams['Jongens'] = [];
        $groupedTeams['Meiden'] = [];
        $groupedTeams['Overig'] = [];

        foreach ($teams as $team) {
            $cat = $team->Category ?? 'Overig';
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
        return $this->repository->getTeamWithRelations($id) ?? null;
    }
}
