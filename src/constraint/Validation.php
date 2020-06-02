<?php

namespace App\src\constraint;

class Validation
{
    protected $constraint;

    public function __construct()
    {
        $this->constraint = new Constraint();
    }

    public function validate($data, $name)
    {
        if($name === 'Account') {
            $accountValidation = new AccountValidation();
            $errors = $accountValidation->check($data);
            return $errors;
        } elseif($name === 'Opinion') {
            $opinionValidation = new OpinionValidation();
            $errors = $opinionValidation->check($data);
            return $errors;
        }
    }
}