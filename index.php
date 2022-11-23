<?php
require_once 'init.php';
if(user() == false) exit(redirect(base_url('auth/logout')));
set_page('Dashboard');
include 'layouts/primary.php';
?>