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

    public function getUpComingByDay(int $days = 4, int $limit = 10): array
    {
        $wedstrijden = $this->repository->getUpcoming($limit);
        $wedstrijden = $this->formatByDay($wedstrijden, $days);
        return $wedstrijden;
    }

    private function formatByDay($wedstrijden, int $days = 4): array
    {
        $formatted = [];
        foreach ($wedstrijden as $wedstrijd) {
            if (count($formatted) >= $days) {
                break;
            }

            $dateKey = date('Y-m-d', strtotime($wedstrijd['date']));
            if (!isset($formatted[$dateKey])) {
                $formatted[$dateKey] = [];
            }
            $formatted[$dateKey][] = [
                'id' => $wedstrijd['id'],
                'team_home' => $wedstrijd['homeTeam']['name'] ?? null,
                'team_away' => $wedstrijd['awayTeam']['name'] ?? null,
                'date' => $wedstrijd['date'],
                'time' => $wedstrijd['time'],
                'location' => $wedstrijd['location'],
                'score' => $wedstrijd['score_home'] . ' - ' . $wedstrijd['score_away'],
            ];
        }
        return $formatted;
    }

    /**
     * Get a wedstrijd with both teams, their spelers, and coaches
     */
    public function getWithTeamsAndDetails(int $id)
    {
        $wedstrijd = $this->repository->get($id);
        if (!$wedstrijd) {
            return null;
        }
        // Eager load teams, spelers, coaches
        $wedstrijd->load([
            'hometeam.spelers.lid',
            'hometeam.coaches.lid',
            'awayTeam.spelers.lid',
            'awayTeam.coaches.lid',
        ]);
        return $wedstrijd;
    }
}
