<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$_ENV['production'] = false; // true or false;
date_default_timezone_set('Asia/Jakarta');

$config['base'] = [
    'app' => [
        'name' => 'SIMPLE CRUD PHP MYSQL',
        'description' => 'SIMPLE CRUD PHP MYSQL'
    ],
    'url' => 'http://localhost/learn/simple-crud-php-mysql/'
];

$config['db'] = [
    'host' => 'localhost',
	'name' => 'learn_simple_crud_php_mysql',
	'username' => 'root',
	'password' => ''
];

CONST LIST_AGAMA = [
    'islam','kristen','katholik','hindu','buddha','khonghucu'
];

