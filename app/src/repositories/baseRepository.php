<?php

namespace App\src\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository implements IBaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function get(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $record = $this->get($id);
        if (!$record) return false;
        return $record->update($data);
    }

    public function delete(int $id): bool
    {
        $record = $this->get($id);
        if (!$record) return false;
        return $record->delete();
    }

    public function forceDelete(int $id): bool
    {
        $record = $this->get($id);
        if (!$record) return false;
        return $record->forceDelete();
    }
}
