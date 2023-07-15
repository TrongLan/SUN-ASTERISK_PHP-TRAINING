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

}
