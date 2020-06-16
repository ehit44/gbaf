<?php

namespace App\src\constraint;

class Constraint
{
    public function notBlank($value)
    {
        if(empty($value)) {
            return 'Le champ saisi est vide';
        }
    }
    public function minLength($value, $minSize)
    {
        if(strlen($value) < $minSize) {
            return 'Minimum '.$minSize.' caractères';
        }
    }
    public function maxLength($value, $maxSize)
    {
        if(strlen($value) > $maxSize) {
            return 'Maximum '.$maxSize.' caractère';
        }
    }
    public function isEqual($name, $value, $nameToConfirm, $valueToConfirm)
    {
        if($value != $valueToConfirm) {
            return 'Le champ '.$name.' doit être égal  au champ '.$nameToConfirm.'';
        }
    }
    public function containsNumber($name, $value)
    {
        if(!preg_match("#[0-9]+#", $value)) {
            return 'Le '.$name.' doit contenir au minimum 1 chiffre';
        }
    }
    public function containsUpper($name, $value)
    {
        if(!preg_match("#[A-Z]+#", $value)) {
            return 'Le '.$name.' doit contenir au minimum 1 majuscule';
        }
    }
    public function containsLower($name, $value)
    {
        if(!preg_match("#[a-z]+#", $value)) {
            return 'Le '.$name.' doit contenir au minimum 1 minuscule';
        }
    }
}