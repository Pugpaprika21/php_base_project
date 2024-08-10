<?php

/* 

$validator = new Validator();

$data = [
    'email' => 'test@example.com',
    'username' => 'eee',
    'age' => 25,
];

$rules = [
    'email' => 'required|email',
    'username' => 'required|min:3|max:20',
    'age' => 'required|numeric',
];

if ($validator->validate($data, $rules)) {
    echo "Data is valid!";
} else {
    print_r($validator->getErrors());
}

*/

namespace App\Helpers;

use Exception;

class Validator
{
    private array $errors = [];

    public function validate(array $data, array $rules): bool
    {
        foreach ($rules as $field => $rule) {
            $value = $data[$field] ?? null;
            $methods = explode('|', $rule);

            foreach ($methods as $method) {
                if (strpos($method, ':') !== false) {
                    list($methodName, $parameter) = explode(':', $method);
                    $methodName = 'validate' . ucfirst($methodName);
                    if (method_exists($this, $methodName)) {
                        $this->$methodName($field, $value, $parameter);
                    } else {
                        throw new Exception("Validation rule $methodName does not exist.");
                    }
                } else {
                    $methodName = 'validate' . ucfirst($method);
                    if (method_exists($this, $methodName)) {
                        $this->$methodName($field, $value);
                    } else {
                        throw new Exception("Validation rule $method does not exist.");
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function validateRequired(string $field, $value)
    {
        if (empty($value) && $value !== '0') {
            $this->errors[$field][] = "$field is required.";
        }
    }

    private function validateEmail(string $field, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "$field must be a valid email address.";
        }
    }

    private function validateMin(string $field, $value, $min)
    {
        if (strlen($value) < $min) {
            $this->errors[$field][] = "$field must be at least $min characters long.";
        }
    }

    private function validateMax(string $field, $value, $max)
    {
        if (strlen($value) > $max) {
            $this->errors[$field][] = "$field must be no more than $max characters long.";
        }
    }

    private function validateNumeric(string $field, $value)
    {
        if (!is_numeric($value)) {
            $this->errors[$field][] = "$field must be a number.";
        }
    }
}
