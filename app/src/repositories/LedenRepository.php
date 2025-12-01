<?php

namespace App\Repositories;

use App\Models\Leden;
use Illuminate\Database\Eloquent\Collection;

class LedenRepository extends BaseRepository
{
    public function __construct(Leden $model)
    {
        parent::__construct($model);
    }

    /**
     * Get a member by email
     */
    public function getByEmail(string $email): ?Leden
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Search members by name (firstname, middlename, lastname)
     */
    public function searchByName(string $name): Collection
    {
        return $this->model->where(function ($query) use ($name) {
            $query->where('firstname', 'like', "%$name%")
                  ->orWhere('middlename', 'like', "%$name%")
                  ->orWhere('lastname', 'like', "%$name%");
        })->get();
    }
}