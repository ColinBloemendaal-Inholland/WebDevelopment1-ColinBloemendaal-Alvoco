<?php

namespace App\Repositories;

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

    public function update(int $id, array $data, ?array $roles = null): Model
    {
        $record = $this->get($id);
        if (!$record) 
            return null;
        $record->update($data);
        if($record && $roles)
            $record->roles()->sync($roles);
        return $this->get($id);
    }

    public function delete(int $id): bool
    {
        $record = $this->get($id);
        if (!$record) return false;
        return $record->delete() ?? false;
    }

    public function destroy(int $id): bool
    {
        $record = $this->get($id);
        if (!$record) return false;
        return $record->forceDelete() ?? false;
    }
}
