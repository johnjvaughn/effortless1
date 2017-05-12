<?php
require('./includes/config.inc.php');
require(MYSQL);
$page_title = 'Register';
include('./includes/header.inc.php');
include('./includes/start_main.inc.php');

$reg_errors = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require('./includes/register/process.inc.php');
}
require('./includes/register/form.inc.php');
include('./includes/footer.inc.php');

