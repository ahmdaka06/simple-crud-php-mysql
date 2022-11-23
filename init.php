<?php
require_once 'config.php';

if(empty($_SESSION)) session_start(); // init session
if ($_ENV['production'] === true) { // init production true or false
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

require_once 'library/class/db.class.php';
require_once 'library/helper/global.helper.php';
require_once 'library/helper/form.helper.php';
require_once 'library/helper/session.helper.php';

$db = new DB($config['db']);
