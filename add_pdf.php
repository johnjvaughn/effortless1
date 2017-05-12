<?php
require('./includes/config.inc.php');
redirect_invalid_user('user_admin');
require(MYSQL);

$page_title = "Add a PDF";
include('./includes/header.inc.php');
include('./includes/start_main.inc.php');
$add_pdf_errors = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  include('./includes/add_pdf/process.inc.php');
} else {
  unset($_SESSION['pdf']);
}
include('./includes/add_pdf/form.inc.php');
include('./includes/footer.inc.php');
