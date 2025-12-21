<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Lid van de volleybalvereniging alvoco en de bijbehorende gegevens.
 * @package App\Models
 */
class Leden extends Model
{
    use SoftDeletes;
    protected $table = "Leden";
    protected $hidden = ['password', 'login_attempts'];
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'gender',
        'date_of_birth',
        'email',
        'password',
        'login_attempts',
        'phone',
        'streetname',
        'streetnumber',
        'postalcode',
        'city',
        'country',
        'emergency_contact_firstname',
        'emergency_contact_middlename',
        'emergency_contact_lastname',
        'emergency_contact_phone'
    ];

    //TODO: Add description of fields
    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'leden_roles', 'leden_id', 'role_id');
    }

    // Check if the user has a role
    public function hasRole(string $roleName): bool
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    // Check if the user has any role in array
    public function hasAnyRole(array $roleNames): bool
    {
        return $this->roles()->whereIn('name', $roleNames)->exists();
    }

    // Relation to Spelers
    public function spelers()
    {
        return $this->hasMany(Spelers::class, 'Leden_id');
    }

    /** Get full name of lid */
    public function getFullnameAttribute()
    {
        $fullname = $this->firstname . ' ';
        if (!empty($this->middlename)) {
            $fullname .= $this->middlename . ' ';
        }
        $fullname .= $this->lastname;
        return $fullname;
    }

    /** Get age of lid */
    public function getAgeAttribute()
    {
        return $this->birthdate ? Carbon::parse($this->birthdate)->age : null;
    }

    /** Get full name of emergency contact */
    public function getEmergencycontactfullnameAttribute()
    {
        $fullname = $this->emergency_contact_firstname . ' ';
        if (!empty($this->emergency_contact_middlename)) {
            $fullname .= $this->emergency_contact_middlename . ' ';
        }
        $fullname .= $this->emergency_contact_lastname;
        return $fullname;
    }

    public function getAdresAttribute()
    {
        return "{$this->streetname} {$this->streetnumber} {$this->postalcode} {$this->city}";
    }
}