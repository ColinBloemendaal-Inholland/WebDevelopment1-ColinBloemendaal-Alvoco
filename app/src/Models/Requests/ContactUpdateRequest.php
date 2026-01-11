<?php
namespace App\Models\Requests;

class ContactUpdateRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'naam' => ['required', 'alpha', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'bericht' => ['required'],
            'bestuurslid_id' => ['required', 'integer', 'min:0'],
        ];
    }
}
