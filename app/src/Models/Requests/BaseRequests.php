<?php

namespace App\Models\Requests;

use App\Factories\ValidatorFactory;

abstract class BaseRequests
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    abstract public function rules(): array;

    public function validate(): array
    {
        $validator = ValidatorFactory::make();
        $validation = $validator->validate($this->data, $this->rules());
        if ($validation->fails()) {
            throw new \Exception(json_encode($validation->errors()->all()));
        }
        return $validation->getValidData();
    }
}
