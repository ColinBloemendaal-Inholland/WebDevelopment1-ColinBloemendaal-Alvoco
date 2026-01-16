<?php

namespace App\Models\Requests;

class LedenUpdateRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'firstname' => 'required|alpha',
            'middlename' => 'alpha',
            'lastname' => 'required|alpha',
            'gender' => 'required|in:M,F,O',
            'date_of_birth' => 'required|date:Y-m-d',
            'email' => 'required|email',
            'phone' => 'required|regex:/^(\+?\d{1,3})?\d{10}$/',
            'streetname' => 'required|alpha',
            'streetnumber' => 'required',
            'postalcode' => 'required',
            'city' => 'required|alpha',
            'country' => 'required|alpha',
            'emergency_contact_firstname' => 'required|alpha',
            'emergency_contact_middlename' => 'alpha',
            'emergency_contact_lastname' => 'required|alpha',
            'emergency_contact_phone' => 'required|regex:/^(\+?\d{1,3})?\d{10}$/',
            'role' => 'array|required',
            'role.*' => 'integer|min:1',
        ];
    }
}
