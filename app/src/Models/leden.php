<?php 

namespace App\Models;

use Carbon\Carbon;
/**
 * Lid van de volleybalvereniging alvoco en de bijbehorende gegevens.
 * @package App\Models
 */
class Leden {
    private $id;
    private $firstname;
    private $middlename;
    private $lastname;
    private $gender;
    private $date_of_birth;
    private $email;
    private $phone;
    private $streetname;
    private $streetnumber;
    private $postalcode;
    private $city;
    private $country;
    private $emergency_contact_firstname;
    private $emergency_contact_middlename;
    private $emergency_contact_lastname;
    private $emergency_contact_phone;    
    private $created_at;
    private $updated_at;
    private $deleted_at;


    /** Get id of lid */
    public function getId() {
        return $this->id;
    }
    /** Set id of lid */
    public function setId(int $id) {
        $this->id = $id;
    }
    /** Get firstname of lid */
    public function getFirstname() {
        return $this->firstname;
    }
    /** Set firstname of lid */
    public function setFirstname(string $firstname) {
        $this->firstname = $firstname;
    }
    /** Get middlename of lid */
    public function getMiddlename() {
        return $this->middlename;
    }
    /** Set middlename of lid */
    public function setMiddlename(string $middlename) {
        $this->middlename = $middlename;
    }
    /** Get lastname of lid */
    public function getLastName() {
        return $this->lastname;
    }
    /** Set lastname of lid */
    public function setLastName(string $lastname) {
        $this->lastname = $lastname;
    }
    /** Get full name of lid */
    public function getFullName() {
        $fullname = $this->getFirstname() . ' ';
        if(!empty($this->getMiddlename())) {
            $fullname .= $this->getMiddlename() . ' ';
        }
        $fullname .= $this->getLastName();
        return $fullname;
    }

    /**get gender of lid */
    public function getGender() {
        return $this->gender;
    }
    /** Set gender of lid */
    public function setGender(string $gender) {
        $this->gender = $gender;
    }
    /** Get date of birth of lid */
    public function getDateOfBirth() {
        return $this->date_of_birth;
    }
    /** Set date of birth of lid */
    public function setDateOfBirth(string $date_of_birth) {
        $this->date_of_birth = $date_of_birth;
    }
    /** Get age of lid */
    public function getAge() {
        return Carbon::parse($this->getDateOfBirth())->age;
    }
    /** Get email of lid */
    public function getEmail() {
        return $this->email;
    }
    /** Set email of lid */
    public function setEmail(string $email) {
        $this->email = $email;
    }
    /** Get phone of lid */
    public function getPhone() {
        return $this->phone;
    }
    /** Set phone of lid */
    public function setPhone(string $phone) {
        $this->phone = $phone;
    }
    /** Get streetname of lid */
    public function getStreetname() {
        return $this->streetname;
    }
    /** Set streetname of lid */
    public function setStreetname(string $streetname) {
        $this->streetname = $streetname;
    }
    /** Get streetnumber of lid */
    public function getStreetnumber() {
        return $this->streetnumber;
    }
    /** Set streetnumber of lid */
    public function setStreetnumber(string $streetnumber) {
        $this->streetnumber = $streetnumber;
    }
    /** Get postalcode of lid */
    public function getPostalcode() {
        return $this->postalcode;
    }
    /** Set postalcode of lid */
    public function setPostalcode(string $postalcode) {
        $this->postalcode = $postalcode;
    }
    /** Get city of lid */
    public function getCity() {
        return $this->city;
    }
    /** Set city of lid */
    public function setCity(string $city) {
        $this->city = $city;
    }
    /** Get country of lid */
    public function getCountry() {
        return $this->country;
    }
    /** Set country of lid */
    public function setCountry(string $country) {
        $this->country = $country;
    }

    /** Get emergency contact firstname of lid */
    public function getEmergency_contact_firstname() {
        return $this->emergency_contact_firstname;
    }
    /** Set emergency contact firstname of lid */
    public function setEmergency_contact_firstname(string $emergency_contact_firstname) {
        $this->emergency_contact_firstname = $emergency_contact_firstname;
    }
    /** Get emergency contact middlename of lid */
    public function getEmergency_contact_middlename() {
        return $this->emergency_contact_middlename;
    }
    /** Set emergency contact middlename of lid */
    public function setEmergency_contact_middlename(string $emergency_contact_middlename) {
        $this->emergency_contact_middlename = $emergency_contact_middlename;
    }
    /** Get emergency contact lastname of lid */
    public function getEmergency_contact_lastname() {
        return $this->emergency_contact_lastname;
    }
    /** Set emergency contact lastname of lid */
    public function setEmergency_contact_lastname(string $emergency_contact_lastname) {
        $this->emergency_contact_lastname = $emergency_contact_lastname;
    }
    /** Get emergency contact full name of lid */
    public function getEmergency_contact_fullname() {
        $fullname = $this->getEmergency_contact_firstname() . ' ';
        if(!empty($this->getEmergency_contact_middlename())) {
            $fullname .= $this->getEmergency_contact_middlename() . ' ';
        }
        $fullname .= $this->getEmergency_contact_lastname();
        return $fullname;
    }
    /** Set emergency contact phone of lid */
    public function getEmergency_contact_phone() {
        return $this->emergency_contact_phone;
    }
    /** Set emergency contact phone of lid */
    public function setEmergency_contact_phone(string $emergency_contact_phone) {
        $this->emergency_contact_phone = $emergency_contact_phone;
    }
    /** Get created at timestamp of lid */
    public function getCreatedAt() {
        return $this->created_at;
    }
    /** Set created at timestamp of lid */
    public function setCreatedAt(string $created_at) {
        $this->created_at = $created_at;
    }
    /** Get updated at timestamp of lid */
    public function getUpdatedAt() {
        return $this->updated_at;
    }
    /** Set updated at timestamp of lid */
    public function setUpdatedAt(string $updated_at) {
        $this->updated_at = $updated_at;
    }
    /** Get deleted at timestamp of lid */
    public function getDeletedAt() {
        return $this->deleted_at;
    }
    /** Set deleted at timestamp of lid */
    public function setDeletedAt(string $deleted_at) {
        $this->deleted_at = $deleted_at;
    }    
}