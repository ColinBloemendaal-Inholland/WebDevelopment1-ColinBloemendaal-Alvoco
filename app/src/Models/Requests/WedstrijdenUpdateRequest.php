<?php

namespace App\Models\Requests;

class WedstrijdenUpdateRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'team_home'=> 'required|integer|min:1',
            'team_away'=> 'required|integer|min:1|different:team_home',
            'date'=> 'required|date:Y-m-d',
            'time'=> 'required|date:H:i',
            'location'=> 'required|alpha',
            'score_home'=> 'nullable|integer|min:0|max:5',
            'score_away'=> 'nullable|integer|min:0|max:5',
            'status'=> 'alpha',
            'referee'=> 'required|alpha',
        ];
    }
}
