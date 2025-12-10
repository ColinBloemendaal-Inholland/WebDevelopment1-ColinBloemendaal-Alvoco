<?php

namespace App\Models\Requests;

class NieuwsberichtenUpdateRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'role' => 'required|alpha',
            'startdate'=> 'required|date:Y-m-d',
            'leden_id'=> 'required|integer|min:1',
            'team_id'=> 'required|integer|min:1'
        ];
    }
}
