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
            'seizoen_id' => 'required|integer|min:0',
            'spelers' => 'required|array',
            'spelers.*' => 'required|integer|min:0',
            'coaches' => 'required|array',
            'coaches.*' => 'required|integer|min:0',
            'trainers' => 'required|array',
            'trainers.*' => 'required|integer|min:0',
        ];
    }
}
