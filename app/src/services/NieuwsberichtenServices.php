<?php

namespace App\Services;

use App\Models\Nieuwsberichten;
use App\Repositories\NieuwsberichtenRepository;

class NieuwsberichtenServices
{
    private NieuwsberichtenRepository $repository;
    public function __construct(?NieuwsberichtenRepository $nieuwsberichtenRepository = null)
    {
        $this->repository = $nieuwsberichtenRepository ?? new NieuwsberichtenRepository(new Nieuwsberichten());
    }

    public function getNieuwsberichtenForDatatable(array $filters, int $start, int $length, int $draw)
    {
        $result = $this->repository->getFilterdNieuwsberichten($filters, $start, $length);
        $formattedResults = $result['data']->map(function ($row) { return $this->format($row);})->toArray();
        return [
            "draw" => $draw,
            "recordsTotal" => $result['recordsTotal'],
            "recordsFiltered" => $result['recordsFiltered'],
            "data" => $formattedResults,
        ];
    }

    public function format($row)
    {
        $leden = $row->Authur->lid ?? null;
        return [
            'fullname' => $leden ? trim($leden->firstname . ' ' . $leden->middlename . ' ' . $leden->lastname) : null,
            'title' => $row->Title,
            'id' => $row->id,
        ];
    }


}