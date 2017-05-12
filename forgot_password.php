<?php
require('./includes/config.inc.php');
require(MYSQL);
$page_title = "Forgot Your Password?";
include('./includes/header.inc.php');

$pass_errors = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  include('./includes/forgot_password/process.inc.php');
}
include('./includes/forgot_password/form.inc.php');
include('./includes/start_main.inc.php');
include('./includes/footer.inc.php');

