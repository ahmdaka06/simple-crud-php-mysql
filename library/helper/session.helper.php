<?php
if (!function_exists('is_login')) {
    function is_login() {
        global $_SESSION;
        if (isset($_SESSION['login'])) return true;
        return false;
    }
}
if (!function_exists('user')) {
    function user(?string $field = null) {
        global $_SESSION, $db;
        if (!isset($_SESSION['user']['id'])) return false;
        $user = $db->query([
            'select' => $field ?? 'id',
            'table' => 'users',
            'where' => 'id = "' . $_SESSION['user']['id'] .'"',
            'first' => true
        ]);
        if ($user['count'] == 0) return false;
        return !is_null($field) ? $user['rows'][$field] : $_SESSION['user']['id'];
    }
}