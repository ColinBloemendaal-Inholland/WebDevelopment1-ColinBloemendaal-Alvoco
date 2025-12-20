<?php

namespace App\Repositories;

use App\Models\Wedstrijden;

class WedstrijdenRepository extends BaseRepository
{
    public function __construct(Wedstrijden $model)
    {
        parent::__construct($model);
    }
    public function filter(array $filters, ?int $start = null, ?int $limit = null): array {
        $query = Wedstrijden::query()->with('homeTeam', 'awayTeam');

        if (!empty($filters['name'])) {
            $query->where('opponent', 'like', '%' . $filters['name'] . '%');
        }
        // Additional filters can be added here

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
}
