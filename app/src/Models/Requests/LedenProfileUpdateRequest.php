<?php
namespace App\Models\Requests;

class LedenStoreRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'firstname' => 'required|min:2|max:50',
            'lastname' => 'required|min:2|max:50',
            'phone' => 'nullable|min:6|max:20',
            'geboortedatum' => 'required|date',
            'streetname' => 'required|min:2|max:100',
            'streetnumber' => 'required|min:1|max:10',
            'postalcode' => 'required|min:4|max:10',
            'city' => 'required|min:2|max:50',
            'country' => 'required|min:2|max:50',
        ];
    }
}