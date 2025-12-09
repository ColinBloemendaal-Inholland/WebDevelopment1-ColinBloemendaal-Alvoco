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

    public function filter(array $filter, int $start, int $length): array
    {
        $query = Leden::query();
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
            $adress = "%{$filter['adress']}%";
            $query->where(function($q) use ($adress) {
                $q->where('streetname', 'like', $adress)
                ->orWhere('streetnumber', 'like', $adress)
                ->orWhere('postalcode', 'like', $adress)
                ->orWhere('city', 'like', $adress);
            });
        }

        // Filter for roles
        if (!empty($filter['role']) && is_array($filter['role'])) {
            $roleIds = array_map('intval', $filter['role']);
            $query->whereHas('roles', function ($q) use ($roleIds) {
                $q->whereIn('Roles.id', $roleIds);
            });
        }

        // Filter for phone
        if (!empty($filter['phone'])) {
            $phone = "%{$filter['phone']}%";
            $query->where('phone','like', $phone);
        }

        //TODO: make this working
        if (isset($filter['trashed']) && $filter['trashed'] == 1) {
            $query->withTrashed();
        }
        
        $filteredCount = $query->count();
        $count = Leden::query()->count();

        $data = $query->skip($start)->take($length)->get();

        return [
            'data'=> $data,
            'recordsFiltered'=> $filteredCount,
            'recordsTotal'=> $count,
        ];
    }
}