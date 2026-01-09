<?php

namespace App\Models\Requests;

class TeamUpdateByCoachRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'spelers' => 'nullable|array',
            'spelers.*' => 'nullable|integer|min:0',
            'trainers' => 'nullable|array',
            'trainers.*' => 'nullable|integer|min:0',
        ];
    }
}
