<?php

// stickyform.php
class StickyForm {

    // Set the value of a field, ensuring it is safely outputted
    public static function setValue($fieldName, $defaultValue = "") {
        return isset($_POST[$fieldName]) ? htmlspecialchars($_POST[$fieldName], ENT_QUOTES, 'UTF-8') : $defaultValue;
    }

    // Set the 'checked' attribute for checkboxes
    public static function setChecked($fieldName, $value) {
        return isset($_POST[$fieldName]) && $_POST[$fieldName] === $value ? "checked" : "";
    }

    // Set the 'selected' attribute for select options
    public static function setSelected($fieldName, $value) {
        return isset($_POST[$fieldName]) && $_POST[$fieldName] === $value ? "selected" : "";
    }

    // Validate a field's value using regex
    public static function validate($fieldName, $regex) {
        if (isset($_POST[$fieldName]) && !preg_match($regex, $_POST[$fieldName])) {
            return "$fieldName format is invalid";
        }
        return "";
    }

    // Check if a required field is empty
    public static function validateRequired($fieldName) {
        if (empty($_POST[$fieldName])) {
            return "$fieldName is required";
        }
        return "";
    }

    // Validate the format and presence of required fields, returning errors if needed
    public static function validateForm($elementsArr) {
        $errors = [];
        foreach ($elementsArr as $fieldName => $settings) {
            // Check if the field is required
            if (isset($settings['required']) && $settings['required']) {
                $error = self::validateRequired($fieldName);
                if ($error) {
                    $errors[$fieldName] = $error;
                }
            }

            // Check if there's a validation regex for the field
            if (isset($settings['regex'])) {
                $error = self::validate($fieldName, $settings['regex']);
                if ($error) {
                    $errors[$fieldName] = $error;
                }
            }

            // Check if there's a specific value to be validated (for select, radio, checkbox)
            if (isset($_POST[$fieldName])) {
                // Make the form sticky
                $settings['value'] = self::setValue($fieldName, $settings['value']);
                $settings['checked'] = self::setChecked($fieldName, $settings['value']);
                $settings['selected'] = self::setSelected($fieldName, $settings['value']);
            }
        }
        return $errors;
    }
}

?>
