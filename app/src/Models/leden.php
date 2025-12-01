<?php 

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Lid van de volleybalvereniging alvoco en de bijbehorende gegevens.
 * @package App\Models
 */
class Leden extends Model {
    use SoftDeletes;
    protected $table = "Leden";
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'gender',
        'date_of_birth',
        'email',
        'phone',
        'streetname',
        'streetnumber',
        'postalcode',
        'city',
        'country',
        'emergency_contact_firstname',
        'emergency_contact_middlename',
        'emergency_contact_lastname',
        'emergency_contact_phone'];

    /** Get full name of lid */
    public function getFullnameAttribute() {
        $fullname = $this->firstname . ' ';
        if(!empty($this->middlename)) {
            $fullname .= $this->middlename . ' ';
        }
        $fullname .= $this->lastname;
        return $fullname;
    }

    /** Get age of lid */
    public function getAgeAttribute() {
        return $this->birthdate ? Carbon::parse($this->birthdate)->age : null;
    }
    public function getEmergency_contact_fullnameAttribute() {
        $fullname = $this->emergency_contact_firstname . ' ';
        if(!empty($this->emergency_contact_middlename)) {
            $fullname .= $this->emergency_contact_middlename . ' ';
        }
        $fullname .= $this->emergency_contact_lastname;
        return $fullname;
    }
}