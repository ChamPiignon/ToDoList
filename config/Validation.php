<?php

class Validation
{
    static function valid_string($string)
    {
        if (isset($string) && !empty($string)) {
            return filter_var($string,FILTER_SANITIZE_STRING);
        } else {
            throw new Exception("email invalid");
        }
    }

    static function valid_mail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
            return filter_var($email,FILTER_SANITIZE_EMAIL);
        } else {
            throw new Exception("email invalid");
        }
    }

    static function valid_url($url)
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    static function valid_int($int)
    {
        if (filter_var($int, FILTER_VALIDATE_INT) && !empty($int)) {
            return filter_var($int,FILTER_SANITIZE_NUMBER_INT);
        } else {
            throw new Exception("integer invalid");
        }
    }
}

