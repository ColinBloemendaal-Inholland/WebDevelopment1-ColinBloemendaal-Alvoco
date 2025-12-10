<?php

namespace App\Models\Requests;

class SpelersUpdateRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'leden_id' => 'required|integer|min:1',
            'team_id' => 'required|integer|min:1',
            'number' => 'required|integer|min:1',
            'position'=> 'required|alpha',
        ];
    }
}
