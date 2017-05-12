<?php
require('./includes/config.inc.php');
redirect_invalid_user();
require(MYSQL);
$page_title = "Change Your Password";
include('./includes/header.inc.php');

$pass_errors = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  include('./includes/change_password/process.inc.php');
}
include('./includes/change_password/form.inc.php');
include('./includes/start_main.inc.php');
include('./includes/footer.inc.php');

