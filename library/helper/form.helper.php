<?php
if (!function_exists('is_method')) {
    function is_method(string $method) {
        if (strtolower($_SERVER['REQUEST_METHOD']) === strtolower($method)) return true;
        return false;
    }
}
if (!function_exists('check_input')) {
    function check_input(array $input, array $data) {
        $input = array_keys($input);
        $false = 0;
        foreach ($data as $key) {
            if (in_array($key, $input) == false) $false++;
        }
        if ($false == 0) return true;
        return false;
    }
}
if (!function_exists('check_empty')) {
    function check_empty(array $input) {
        $result = true;
        foreach ($input as $key => $value) {
            $result = false;
            if (empty($value) == true) {
                $result = true;
                break;
            }
        }
        return $result;
    }
}