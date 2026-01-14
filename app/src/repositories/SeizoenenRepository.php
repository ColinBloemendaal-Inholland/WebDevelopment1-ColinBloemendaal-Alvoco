<?php

namespace App\Repositories;
use App\Models\Seizoenen;
use Illuminate\Database\Eloquent\Collection;

class SeizoenenRepository extends BaseRepository
{
    public function create(array $data): Seizoenen
    {
        $oldCurrent = Seizoenen::where('is_current', 1)->first();
        if ($oldCurrent && ($data['is_current'] ?? 0) == 1) {
            $oldCurrent->is_current = 0;
            $oldCurrent->save();
        }
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Seizoenen
    {
        $seizoen = $this->model->findOrFail($id);
        if (($data['is_current']) == 1) {
            Seizoenen::where('is_current', 1)->where('id', '!=', $seizoen->id)->update(['is_current' => 0]);
        }
        $seizoen->update($data);
        return $seizoen->refresh();
    }

    public function filter(array $filters, ?int $start = null, ?int $limit = null): array
    {
        $query = Seizoenen::query();

        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if(isset($filters['trashed']) && $filters['trashed'] == 1) {
            $query->onlyTrashed();
        }

        $total = Seizoenen::count();
        $recordsFiltered = $query->count();

        if ($start !== null) {
            $query->skip($start);
        }
        if ($limit !== null) {
            $query->take($limit);
        }

        $results = $query->get();

        return [
            'data' => $results,
            'recordsTotal' => $total,
            'recordsFiltered' => $recordsFiltered,
        ];
    }
}
