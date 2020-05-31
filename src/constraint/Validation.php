<?php

namespace App\src\constraint;

class Validation
{
    public function validate($data, $name)
    {
        if($name === 'Account') {
            $accountValidation = new AccountValidation();
            $errors = $accountValidation->check($data);
            return $errors;
        }
    }
}