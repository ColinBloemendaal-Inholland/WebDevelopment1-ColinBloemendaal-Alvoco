<?php

namespace App\Models\Requests;

class RolesUpdateRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'name' => 'required|alpha',
            'power'=> 'required|integer|min:0'
        ];
    }
}
