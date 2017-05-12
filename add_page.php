<?php
require('./includes/config.inc.php');
redirect_invalid_user('user_admin');
require(MYSQL);

$page_title = "Add a Site Content Page";
include('./includes/header.inc.php');
include('./includes/start_main.inc.php');
$add_page_errors = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  include('./includes/add_page/process.inc.php');
}
include('./includes/add_page/form.inc.php');
include('./includes/footer.inc.php');
