<?php

namespace App\Repositories;

use App\Models\Wedstrijden;

class WedstrijdenRepository extends BaseRepository
{
    public function filter(array $filters, ?int $start = null, ?int $limit = null): array {
        $query = Wedstrijden::query()->with('homeTeam', 'awayTeam');

        if (!empty($filters['homeTeam'])) {
            $query->whereRelation('homeTeam', 'id', $filters['homeTeam']);
        }
        if (!empty($filters['awayTeam'])) {
            $query->whereRelation('awayTeam', 'id', $filters['awayTeam']);
        }
        if (!empty($filters['homeScore'])) {
            $query->where('score_home', operator: $filters['homeScore']);
        }
        if (!empty($filters['awayScore'])) {
            $query->where('score_away', operator: $filters['awayScore']);
        }

        $recordsTotal = Wedstrijden::count();
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
    public function getUpcoming(int $limit = 10)
    {
        $query = Wedstrijden::query()
            ->with('homeTeam', 'awayTeam')
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->limit($limit);
        return $query->get();
    }
}
