<?php

namespace App\Models\Requests;

class BestuursledenStoreRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'role' => 'required|alpha',
            'start_date'=> 'required|date:Y-m-d',
            'leden_id'=> 'required|integer|min:1'
        ];
    }
}
