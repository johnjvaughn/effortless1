<?php
require('./includes/config.inc.php');
#redirect_invalid_user('reg_user_id');
require(MYSQL);

$page_title = "Thanks!";
include('./includes/header.inc.php');
include('./includes/start_main.inc.php');
#$reg_user_id = filter_var($_SESSION['reg_user_id'], FILTER_VALIDATE_INT, array('min_range' => 1));
#if ($reg_user_id) {
 # $q = "UPDATE users SET date_expires = ADDDATE(date_expires, INTERVAL 1 YEAR) WHERE id='$reg_user_id'";
#  $r = mysqli_query($dbc, $q);
#}
#unset($_SESSION['reg_user_id']);
//IPN will update user's account
echo THANKS_MSG;
include('./includes/footer.inc.php');
