<?php

namespace App\Models\Requests;

use App\Factories\ValidatorFactory;
use Exception;

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
            $errors = $validation->errors()->all();
            if (!is_array($errors)) {
                $errors = [$errors];
            }
            throw new Exception(json_encode($errors, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        }
        return $validation->getValidData();
    }
}
