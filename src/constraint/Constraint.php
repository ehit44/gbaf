<?php

namespace App\src\constraint;

class Constraint
{
    public function notBlank($value)
    {
        if(empty($value)) {
            return '<p>Le champ saisi est vide</p>';
        }
    }
    public function minLength($value, $minSize)
    {
        if(strlen($value) < $minSize) {
            return '<p>Minimum '.$minSize.' caractères </p>';
        }
    }
    public function maxLength($value, $maxSize)
    {
        if(strlen($value) > $maxSize) {
            return '<p>Maximum '.$maxSize.' caractères</p>';
        }
    }
    public function isEqual($name, $value, $nameToConfirm, $valueToConfirm)
    {
        if($value != $valueToConfirm) {
            return '<p>Le champ '.$name.' doit être égal  au champ '.$nameToConfirm.' </p>';
        }
    }
    public function containsNumber($name, $value)
    {
        if(!preg_match("#[0-9]+#", $value)) {
            return '<p>Le '.$name.' doit contenir au minimum 1 chiffre </p>';
        }
    }
    public function containsUpper($name, $value)
    {
        if(!preg_match("#[A-Z]+#", $value)) {
            return '<p>Le '.$name.' doit contenir au minimum 1 majuscule </p>';
        }
    }
    public function containsLower($name, $value)
    {
        if(!preg_match("#[a-z]+#", $value)) {
            return '<p>Le '.$name.' doit contenir au minimum 1 minuscule </p>';
        }
    }
}