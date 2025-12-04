<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IBaseRepository
{
    /**
     * Get a single record by its ID
     */
    public function get(int $id): ?Model;

    /**
     * Get all records
     */
    public function getAll(): Collection;

    /**
     * Create a new record with given data
     */
    public function create(array $data): Model;

    /**
     * Update a record by ID with given data
     */
    public function update(int $id, array $data): bool;

    /**
     * Soft delete a record by ID
     */
    public function delete(int $id): bool;

    /**
     * Force delete a record by ID
     */
    public function forceDelete(int $id): bool;
}
