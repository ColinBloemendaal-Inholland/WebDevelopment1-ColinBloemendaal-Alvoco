<?php

namespace App\Models\Requests;

class BestuursledenUpdateRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'role' => 'required|alpha',
            'start_date'=> 'required|date:Y-m-d',
            'end_date'=> 'nullable|date:Y-m-d',
            'Leden_id'=> 'required|integer|min:0'
        ];
    }
}
