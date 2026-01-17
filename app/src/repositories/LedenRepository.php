<?php

namespace App\Repositories;

use App\Models\Bestuursleden;
use App\Models\Coaches;
use App\Models\Leden;
use App\Models\Nieuwsberichten;
use App\Models\Roles;
use App\Models\Trainers;
use Illuminate\Database\Eloquent\Collection;

class LedenRepository extends BaseRepository
{
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
    public function removeRole(Leden $user, string $roleName): bool
    {
        $role = Roles::where('name', $roleName)->first();
        if ($role) {
            $result = $user->roles()->detach($role->id);
            if ($result > 0) {
                return true;
            }
        }
        return false;
    }

    public function getAllWithNoSpeler($spelerIds = []): Collection
    {
        $spelerIds = array_map('intval', $spelerIds);
        return Leden::whereDoesntHave('spelers')->orWhereIn('id', $spelerIds)->get();
    }

    public function filter(array $filter, int $start, int $length): array
    {
        $query = Leden::query();
        // filter for name
        if (!empty($filter['name'])) {
            $name = "%{$filter['name']}%";
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
            $query->where(function ($q) use ($adress) {
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
            $query->where('phone', 'like', $phone);
        }

        if (isset($filter['trashed']) && $filter['trashed'] == 1) {
            $query->onlyTrashed();
        }

        $filteredCount = $query->count();
        $count = Leden::query()->count();

        $data = $query->skip($start)->take($length)->get();

        return [
            'data' => $data,
            'recordsFiltered' => $filteredCount,
            'recordsTotal' => $count,
        ];
    }
    public function updateProfile(int $id, array $data)
    {
        $user = $this->model->find($id);
        if (!$user) {
            return false;
        }
        foreach ($data as $key => $value) {
            $user->$key = $value;
        }
        $user->save();
        return $user;
    }

    /**
     * Get all teams coached by a user, with spelers, trainers, coaches, and upcoming games
     */
    public function getTeamsCoachedWithDetails(int $ledenId)
    {
        $coaches = Coaches::with([
            'team.spelers.lid',
            'team.trainers.lid',
            'team.coaches.lid',
            'team.wedstrijdenHome',
            'team.wedstrijdenAway',
        ])->where('Leden_id', $ledenId)->get();

        $teams = collect();
        foreach ($coaches as $coach) {
            if ($coach->team) {
                $team = $coach->team;
                $team->upcoming_games = $team->wedstrijden
                    ->where('date', '>=', date('Y-m-d'))
                    ->sortBy('date')
                    ->take(3);
                $teams->push($team);
            }
        }
        return $teams;
    }

    /**
     * Get all teams trained by a user, with spelers, trainers, coaches, and upcoming games
     */
    public function getTeamsTrainedWithDetails(int $ledenId)
    {
        $trainers = Trainers::with([
            'team.spelers.lid',
            'team.trainers.lid',
            'team.coaches.lid',
            'team.wedstrijdenHome',
            'team.wedstrijdenAway',
        ])->where('Leden_id', $ledenId)
            ->get();

        $teams = collect();
        foreach ($trainers as $trainer) {
            if ($trainer->team) {
                $team = $trainer->team;
                $team->upcoming_games = $team->wedstrijden
                    ->where('date', '>=', date('Y-m-d'))
                    ->sortBy('date')
                    ->take(3);
                $teams->push($team);
            }
        }
        return $teams;
    }

    /**
     * Get 5 most recent news articles for a bestuurslid
     */
    public function getRecentNewsForBestuurslid(int $ledenId)
    {
        $bestuurslid = Bestuursleden::where('Leden_id', $ledenId)->first();
        if (!$bestuurslid) {
            return collect();
        }
        return Nieuwsberichten::where('Bestuursleden_id', $bestuurslid->id)
            ->orderByDesc('created_at')
            ->take(5)
            ->get();
    }

    /**
     * Overwrites BaseRepository's create behaviour. Create's a new lid and sets their roles.
     * @param array $data
     * @return Leden
     */
    public function create(array $data): Leden
    {
        $roles = $data['role'] ?? [];
        unset($data['role']);
        $user = new Leden();
        foreach ($data as $key => $value) {
            $user->$key = $value;
        }
        $user->save();
        $user->refresh();
        $user->roles()->sync($roles);
        return $user;
    }

    /**
     * Overwrites BaseRepository's update behaviour. Updates a lid and their roles.
     * @param int $id
     * @param array $data
     */
    public function update(int $id, array $data): Leden
    {
        $roles = $data['role'] ?? [];
        unset($data['role']);
        $user = $this->model->findOrFail($id);
        foreach ($data as $key => $value) {
            $user->$key = $value;
        }
        $user->roles()->sync($roles);
        $user->save();
        return $user;
    }

    public function destroyAll(): int
    {
        return $this->model->onlyTrashed()->forceDelete();
    }

    public function getTrashed(): Collection
    {
        return $this->model->onlyTrashed()->where('deleted_at', '!=', null)->get();
    }
}
