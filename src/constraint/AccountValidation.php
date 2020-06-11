<?php

namespace App\src\constraint;
use App\config\Parameter;

class AccountValidation extends Validation
{
    private $errors = [];
    protected $constraint;

    public function __construct()
    {
        $this->constraint = new Constraint();
    }

    public function check(Parameter $post)
    {
        foreach ($post->all() as $key => $value) {
            $this->checkField($key, $value);
        }
        return $this->errors;
    }

    private function checkField($name, $value)
    {
        if($name === 'name' || $name === 'firstName' || $name === 'username') {
            $error = $this->checkMediumText($value);
            $this->addError($name, $error);
        }
        elseif ($name === 'password') {
            $error = $this->checkPassword($name, $value);
            $this->addError($name, $error);
        }
        elseif ($name === 'question' || $name === 'response') {
            $error = $this->checkLargeText($value);
            $this->addError($name, $error);
        }
    }

    private function addError($name, $error) {
        if($error) {
            $this->errors += [
                $name => $error
            ];
        }
    }

    private function checkMediumText($value)
    {
        if($this->constraint->notBlank($value)) {
            return $this->constraint->notBlank($value);
        }
        if($this->constraint->minLength($value, 2)) {
            return $this->constraint->minLength($value, 2);
        }
        if($this->constraint->maxLength($value, 100)) {
            return $this->constraint->maxLength($value, 100);
        }
    }

    private function checkLargeText($value)
    {
        if($this->constraint->notBlank($value)) {
            return $this->constraint->notBlank($value);
        }
        if($this->constraint->minLength($value, 2)) {
            return $this->constraint->minLength($value, 2);
        }
        if($this->constraint->maxLength($value, 255)) {
            return $this->constraint->maxLength($value, 255);
        }
    }

    private function checkPassword($name, $value)
    {
        if($this->constraint->notBlank($value)) {
            return $this->constraint->notBlank($value);
        }
        if($this->constraint->minLength($value, 4)) {
            return $this->constraint->minLength($value, 4);
        }
        if($this->constraint->maxLength($value, 60)) {
            return $this->constraint->maxLength($value, 60);
        }
        if($this->constraint->containsNumber($name, $value)) {
            return $this->constraint->containsNumber('mot de passe', $value);
        }
        if($this->constraint->containsUpper($name, $value)) {
            return $this->constraint->containsUpper('mot de passe', $value);
        }
        if($this->constraint->containsLower($name, $value)) {
            return $this->constraint->containsLower('mot de passe', $value);
        }
    }
}