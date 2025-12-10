<?php

namespace App\Requests;

class LedenUpdateRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer|min:1',
            'firstname' => 'required|alpha',
            'middlename' => 'alpha',
            'lastname' => 'required|alpha',
            'gender' => 'required|in:M,F,O',
            'date_of_birth' => 'required|date:Y-m-d',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password',
            'phone' => 'required',
            'streetname' => 'required|alpha',
            'streetnumber' => 'required',
            'postalcode' => 'required',
            'city' => 'required|alpha',
            'country' => 'required|alpha',
            'emergency_contact_firstname' => 'required|alpha',
            'emergency_contact_middlename' => 'alpha',
            'emergency_contact_lastname' => 'required|alpha',
            'emergency_contact_phone' => 'required'
        ];
    }
}
