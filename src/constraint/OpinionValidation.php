<?php

namespace App\src\constraint;
use App\config\Parameter;

class OpinionValidation extends Validation
{
    private $errors = [];

    public function check(Parameter $post)
    {
        foreach ($post->all() as $key => $value) {
            $this->checkField($key, $value);
        }
        return $this->errors;
    }

    private function checkField($name, $value)
    {
        if($name === 'opinion') {
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

    private function checkLargeText($value)
    {
        if($this->constraint->notBlank($value)) {
            return $this->constraint->notBlank($value);
        }
        if($this->constraint->minLength($value, 10)) {
            return $this->constraint->minLength($value, 10);
        }
        if($this->constraint->maxLength($value, 500)) {
            return $this->constraint->maxLength($value, 500);
        }
    }
}