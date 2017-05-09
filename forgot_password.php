<?php
require('./includes/config.inc.php');
require(MYSQL);
$page_title = "Forgot Your Password?";
include('./includes/_header.inc.php');

$pass_errors = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  include('./includes/forgot_password/_process.inc.php');
}
include('./includes/forgot_password/_form.inc.php');
include('./includes/_start_main.inc.php');
include('./includes/_footer.inc.php');

