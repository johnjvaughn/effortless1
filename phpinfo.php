<?php
require('./includes/config.inc.php');
redirect_invalid_user('user_admin');
require(MYSQL);
include('./includes/header.inc.php');
include('./includes/start_main.inc.php');
phpinfo();
include('./includes/footer.inc.php');