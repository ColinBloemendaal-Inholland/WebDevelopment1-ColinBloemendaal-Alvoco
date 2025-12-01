<?php

namespace App\src\Repositories;

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

        /** Verify the password for the given user */
    public function verifyPassword(Leden $user, string $password): bool{
        return password_verify($password, $user->password);
    }

    /** Check if the user has any of the allowed roles */
    public function checkRole(Leden $user, array $allowedRoles): bool {
        return $user->hasAnyRole($allowedRoles);
    }

    /** Assign a role to the user */
    public function assignRole(Leden $user, string $roleName) {
        $role = Roles::firstOrCreate(['name' => $roleName]);
        $user->roles()->syncWithoutDetaching([$role->id]);
    }

    /** Remove a role from the user */
    public function removeRole(Leden $user, string $roleName){
        $role = Roles::where('name', $roleName)->first();
        if ($role) $user->roles()->detach($role->id);
    }

    //TODO: Add search by phone number / emergency contact phone number

    //TODO: Add search by address (city, streetname, postalcode)

}