<?php

namespace App\Models\Requests;

class SpelersStoreRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'Leden_id' => 'required|integer|min:0',
            'team_id' => 'required|integer|min:0',
            'number' => 'required|integer|min:0',
            'position'=> 'required',
        ];
    }
}
