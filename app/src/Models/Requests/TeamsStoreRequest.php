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
            'spelers' => 'nullable|array',
            'spelers.*' => 'nullable|integer|min:0',
            'coaches' => 'nullable|array',
            'coaches.*' => 'nullable|integer|min:0',
            'trainers' => 'nullable|array',
            'trainers.*' => 'nullable|integer|min:0',
        ];
    }
}
