<?php

namespace App\Models\Requests;

class SeizoenenStoreRequest extends BaseRequests
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:9',
            'is_current'=> 'boolean',
        ];
    }
}
