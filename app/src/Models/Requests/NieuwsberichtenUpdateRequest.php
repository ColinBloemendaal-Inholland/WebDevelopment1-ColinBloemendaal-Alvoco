<?php

namespace App\Models\Requests;

class NieuwsberichtenUpdateRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'Title' => 'required',
            'Message'=> 'required',
            'Bestuursleden_id'=> 'required|integer|min:0',
        ];
    }
}
