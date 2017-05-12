<?php
require('./includes/config.inc.php');
require(MYSQL);

$page_title = "Cancel";
include('./includes/header.inc.php');
include('./includes/start_main.inc.php');
echo CANCEL_MSG;
include('./includes/footer.inc.php');