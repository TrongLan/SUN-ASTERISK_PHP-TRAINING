<?php

class CustomValidator
{

    public static function commonValidate(array $fields): array
    {
        $errors = [];

        foreach ($fields as $k => $v) {
            if (empty($v)) {
                $errors[$k] = $k . " is required.";
            }
        }

        return $errors;
    }

    public static function lengthValidation(array $fields): array
    {
        $errors = [];

        foreach ($fields as $k => $v) {
            if (strlen($v[0]) > $v[1]) {
                $errors[$k] = $k . " cannot be longer than " . $v[1] . " characters.";
            }
        }

        return $errors;
    }

    public static function numberValidation(array $fields): array
    {
        $errors = [];

        foreach ($fields as $k => $v) {
            if (!is_numeric($v[0])) {
                $errors[$k] = $k . " must be in number format.";
            }else{
                if ($v[0] < $v[1][0] || $v[0] > $v[1][1]) {
                    $errors[$k] = $k . " must be in range [" . $v[1][0] . ", " . $v[1][1] . "].";
                }
            }
        }

        return $errors;
    }

}
