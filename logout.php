<?php
require('./includes/config.inc.php');

redirect_invalid_user();
$_SESSION = array();
session_destroy();
setcookie(session_name(), '', time()-300);

require(MYSQL);
$page_title = "Logout";
include('./includes/_header.inc.php');
include('./includes/login/_form.inc.php');
include('./includes/_start_main.inc.php');
echo "<div class='alert alert-success'>".AUTH_LOGOUT_SUCCESS."</div>";
include('./includes/_footer.inc.php');

