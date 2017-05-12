<?php
if (empty($msg)) $msg = 'This page has been accessed in error.';
if (empty($div_class)) $div_class = 'alert alert-danger';
include('./includes/header.inc.php');
if (!isset($_SESSION['user_id'])) require("includes/login/form.inc.php");
include('./includes/start_main.inc.php');
echo "<div class='$div_class'>$msg</div>";
include('./includes/footer.inc.php');
exit;
