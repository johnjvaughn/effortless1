<?php
require('./includes/config.inc.php');
redirect_invalid_user();
require(MYSQL);
$page_title = "Change Your Password";
include('./includes/_header.inc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  include('./includes/change_password/_process.inc.php');
}
include('./includes/change_password/_form.inc.php');
include('./includes/_start_main.inc.php');
include('./includes/_footer.inc.php');

