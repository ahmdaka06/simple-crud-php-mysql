<?php
require '../init.php';

session_destroy();
exit(redirect(base_url('auth.login')));