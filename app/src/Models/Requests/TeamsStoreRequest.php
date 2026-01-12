<?php

namespace App\Models\Requests;

class TeamsStoreRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'class' => 'required',
            'category' => 'required',
            'spelers' => 'required|array',
            'spelers.*' => 'required|integer|min:0',
            'coaches' => 'required|array',
            'coaches.*' => 'required|integer|min:0',
            'trainers' => 'required|array',
            'trainers.*' => 'required|integer|min:0',
        ];
    }
}
