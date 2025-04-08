<?php
function validateStringLength($string, $minLength = 1, $maxLength = 255) {
    $length = strlen($string);
    return ($length >= $minLength && $length <= $maxLength);
}
function validateTimestamp($timestamp) {
    return (is_int($timestamp) || ctype_digit($timestamp)) && $timestamp > 0;
}
function validateType($value, $type) {
    switch ($type) {
        case 'int':
            return is_int($value) || ctype_digit($value);
        case 'string':
            return is_string($value);
        case 'array':
            return is_array($value);
        case 'bool':
            return is_bool($value);
        default:
            return false;
    }
}
?>