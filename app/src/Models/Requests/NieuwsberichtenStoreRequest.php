<?php

namespace App\Models\Requests;

class NieuwsberichtenStoreRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'title' => 'required|alpha',
            'message'=> 'required|date:Y-m-d',
            'bestuursleden_id'=> 'required|integer|min:1',
        ];
    }
}
