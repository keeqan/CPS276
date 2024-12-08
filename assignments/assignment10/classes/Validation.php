<?php

// validation.php
class Validation {

    public static function isRequired($value) {
        return trim($value) !== "";
    }

    public static function isEmail($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function isNumber($value) {
        return is_numeric($value);
    }

    public static function minLength($value, $minLength) {
        return strlen($value) >= $minLength;
    }

    public static function maxLength($value, $maxLength) {
        return strlen($value) <= $maxLength;
    }

    public static function matchesPattern($value, $pattern) {
        return preg_match($pattern, $value);
    }

    public static function checkRequired(array $values) {
        echo "Inside checkRequired method\n"; // Debugging line
        foreach ($values as $value) {
            if (!self::isRequired($value)) {
                return false;
            }
        }
        return true;
    }
    

    public static function validate(array $rules, array $data) {
        $errors = [];

        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule => $ruleValue) {
                $value = isset($data[$field]) ? $data[$field] : "";

                if ($rule === 'required' && $ruleValue && !self::isRequired($value)) {
                    $errors[$field] = "$field is required.";
                }
                if ($rule === 'email' && $ruleValue && !self::isEmail($value)) {
                    $errors[$field] = "$field must be a valid email address.";
                }
                if ($rule === 'number' && $ruleValue && !self::isNumber($value)) {
                    $errors[$field] = "$field must be a number.";
                }
                if ($rule === 'minLength' && !self::minLength($value, $ruleValue)) {
                    $errors[$field] = "$field must be at least $ruleValue characters long.";
                }
                if ($rule === 'maxLength' && !self::maxLength($value, $ruleValue)) {
                    $errors[$field] = "$field must be no more than $ruleValue characters long.";
                }
                if ($rule === 'pattern' && !self::matchesPattern($value, $ruleValue)) {
                    $errors[$field] = "$field is invalid.";
                }
            }
        }

        return $errors;
    }
}

?>