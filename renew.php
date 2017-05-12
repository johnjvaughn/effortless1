<?php
require('./includes/config.inc.php');
redirect_invalid_user();
require(MYSQL);
$page_title = 'Renew Your Account';
include('./includes/header.inc.php');
include('./includes/start_main.inc.php');
require('./includes/renew/form.inc.php');
include('./includes/footer.inc.php');

