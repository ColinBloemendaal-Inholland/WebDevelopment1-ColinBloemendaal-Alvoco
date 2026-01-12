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
        //TODO: Als er tijd over is ook de foutmeldingen nederlands talig maken
        $validator = ValidatorFactory::make();
        $validator->setMessages(require ROOT . 'src/lang/nl.php');
        $validation = $validator->validate($this->data, $this->rules());
        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            if (!is_array($errors)) {
                $errors = [$errors];
            }
            throw new Exception(json_encode($errors, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        }
        $validData = $validation->getValidData();
        foreach ($validData as $key => $value) {
            if (is_string($value)) {
                $validData[$key] = htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            }
        }
        return $validData;
    }
}
