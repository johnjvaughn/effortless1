<?php
require('./includes/config.inc.php');

redirect_invalid_user();
$_SESSION = array();
session_destroy();
setcookie(session_name(), '', time()-300);

require(MYSQL);
$page_title = "Logout";
$msg = AUTH_LOGOUT_SUCCESS;
include(MESSAGE_AND_EXIT);


