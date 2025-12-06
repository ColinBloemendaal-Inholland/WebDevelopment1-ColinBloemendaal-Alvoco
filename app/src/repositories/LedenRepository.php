<?php

namespace App\Repositories;

use App\Models\Leden;
use App\Models\Roles;
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

    public function getById(int $id): ?Leden
    {
        return $this->model->find($id);
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

    /** Verify the password for the given user */
    public function verifyPassword(Leden $user, string $password): bool
    {
        return password_verify($password, $user->password);
    }

    /** Check if the user has any of the allowed roles */
    public function checkRole(Leden $user, array $allowedRoles): bool
    {
        return $user->hasAnyRole($allowedRoles);
    }

    /** Assign a role to the user */
    public function assignRole(Leden $user, string $roleName)
    {
        $role = Roles::firstOrCreate(['name' => $roleName]);
        $user->roles()->syncWithoutDetaching([$role->id]);
    }

    /** Remove a role from the user */
    public function removeRole(Leden $user, string $roleName)
    {
        $role = Roles::where('name', $roleName)->first();
        if ($role)
            $user->roles()->detach($role->id);
    }

    public function getFilterdLeden(array $filter, int $start, int $length)
    {
        $query = $this->model->newQuery();
        $count = $query->count();
        // filter for name
        if (!empty($filter['name'])) {
            $name =  "%{$filter['name']}%";
            $query->where(function ($q) use ($name) {
                $q->where('firstname', 'like', $name)
                    ->orWhere('middlename', 'like', $name)
                    ->orWhere('lastname', 'like', $name)
                    ->orWhere('email', 'like', $name);
            });
        }

        // Filter for adress
        if (!empty($filter['adress'])) {
            $adress = '%' . $filter['adress'] . '%';
            $query->where(function($q) use ($adress) {
                $q->where('streetname', 'like', $adress)
                ->orWhere('streetnumber', 'like', $adress)
                ->orWhere('postalcode', 'like', $adress)
                ->orWhere('city', 'like', $adress);
            });
        }
        //TODO: fix this
        if (!empty($filter['role']) && is_array($filter['role'])) {
            $query->whereHas('roles', function ($q) use ($filter) {
                $q->whereIn('roles.id', $filter['role']);
            });
        }
        
        $filteredCount = $query->count();

        $data = $query->skip($start)->take($length)->get();

        return [
            'data'=> $data,
            'recordsFiltered'=> $filteredCount,
            'recordsTotal'=> $count,
        ];
    }

    //TODO: Add search by phone number / emergency contact phone number

    //TODO: Add search by address (city, streetname, postalcode)

}