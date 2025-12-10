<?php

namespace App\Models\Requests;

class TeamsStoreRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'name' => 'required|alpha',
            'class' => 'required|alpha',
            'category' => 'required|alpha',
        ];
    }
}
