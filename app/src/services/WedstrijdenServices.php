<?php

namespace App\Services;

use App\Models\Wedstrijden;
use App\Repositories\WedstrijdenRepository;

class WedstrijdenServices implements IServices
{
    private WedstrijdenRepository $repository;
    public function __construct()
    {
        $this->repository = new WedstrijdenRepository(new Wedstrijden());
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
        return $this->repository->create($data) ?? null;
    }
    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data) ?? null;
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
        // Remove spaces around the dash and split by dash
        $parts = preg_split('/\s*-\s*/', $filters['score'] ?? '');

        $filters['homeScore'] = $parts[0] ?? null;
        $filters['awayScore'] = $parts[1] ?? null;
        return $this->repository->filter($filters, $start, $limit);
    }
    public function datatable(array $filters, int $start, $length, int $draw): array
    {
        $result = $this->filter($filters, $start, $length);
        $formattedResults = $result['data']->map(function ($row) {
            return $this->format($row);
        })->toArray() ?? [];
        return [
            "draw" => $draw,
            "recordsTotal" => $result['recordsTotal'],
            "recordsFiltered" => $result['recordsFiltered'],
            "data" => $formattedResults,
        ];
    }
    private function format($row): array
    {
        return [
            'id' => $row['id'],
            'teamHome' => $row['homeTeam']['name'],
            'teamAway' => $row['awayTeam']['name'],
            'date' => $row['date'],
            'time' => $row['time'],
            'location' => $row['location'],
            'score' => $row['score_home'] . ' - ' . $row['score_away'],
        ];
    }
}
