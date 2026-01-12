<?php

namespace App\Models\Requests;

class WedstrijdenUpdateRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'team_home'=> 'required|integer|min:1',
            'team_away'=> 'required|integer|min:1',
            'date'=> 'required|date:Y-m-d',
            'time'=> 'required|date_format:H:i',
            'location'=> 'required|alpha',
            'score_home'=> 'integer|min:0|max:5',
            'score_away'=> 'integer|min:0|max:5',
            'status'=> 'alpha',
            'referee'=> 'required|alpha',
        ];
    }
}
