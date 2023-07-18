<?php

class CustomValidator
{

    public static function commonValidate(array $fields)
    {
        $errors = [];

        foreach ($fields as $k => $v) {
            if (empty($v)) {
                $errors[$k] = $k . " is required.";
            }
        }

        return $errors;
    }

    public static function lengthValidation(array $fields)
    {
        $errors = [];

        foreach ($fields as $k => $v) {
            if (strlen($v[0]) > $v[1]) {
                $errors[$k] = $k . " cannot be longer than " . $v[1] . " characters.";
            }
        }

        return $errors;
    }

}
