<?php

namespace App\Repositories;

use App\Models\Nieuwsberichten;

class NieuwsberichtenRepository extends BaseRepository
{
    public function __construct(Nieuwsberichten $model)
    {
        parent::__construct($model);
    }

    public function filter(array $filter, int $start, int $length)
    {
        $query = Nieuwsberichten::query()
            ->select('id', 'Title', 'Bestuursleden_id')
            ->with([
                'Authur:id,Leden_id', 
                'Authur.lid:id,firstname,middlename,lastname'
            ]);

        // Filter for title
        if (!empty($filter['title'])) {
            $title = "%{$filter['title']}%";
            $query->where('Title', 'like', $title);
        }

        // Filter for author name
        if (!empty($filter['authur'])) {
            $authorName = "%{$filter['authur']}%";
            $query->whereHas('Authur', function ($q) use ($authorName) {
                $q->whereHas('lid', function ($q2) use ($authorName) {
                    $q2->where('firstname', 'like', $authorName)
                        ->orWhere('middlename', 'like', $authorName)
                        ->orWhere('lastname', 'like', $authorName);
                });
            });
        }

        // Filter for published date range
        if (!empty($filter['dateFrom'])) {
            $query->where('created_at', '>=', $filter['dateFrom']);
        }
        if (!empty($filter['dateTill'])) {
            $query->where('created_at', '<=', $filter['dateTill']);
        }

        // Handle trashed
        if (isset($filter['trashed']) && $filter['trashed'] == 1) {
            $query->withTrashed();
        }

        if (isset($filter['orderColumn']) && isset($filter['orderDir']))
            $query->orderBy($filter['orderColumn'] ?? 'Title' ,$filter['orderDir'] ?? 'asc');

        $filteredCount = $query->count();
        $totalCount = Nieuwsberichten::query()->count();
        if(isset($start) && $length)
            $data = $query->skip($start)->take($length)->get();
        else 
            $data = $query->get();

        return [
            'data' => $data,
            'recordsFiltered' => $filteredCount,
            'recordsTotal' => $totalCount,
        ];
    }
}