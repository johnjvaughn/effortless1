<?php
require('./includes/auth_functions.inc.php');

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  $e = escape_data($_POST['email'], $dbc);
} else {
  $pass_errors['email'] = AUTH_ENTER_EMAIL;
}

if (empty($pass_errors)) {
  $q = "SELECT id FROM users WHERE email='$e'";
  $r = mysqli_query($dbc, $q);
  if (mysqli_num_rows($r) === 1) {
    list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);
    $p = substr(md5(uniqid(rand(), true)), 10, 15);
    $hash = my_password_hash($p);
    $q = "UPDATE users SET pass='$hash' WHERE id=$uid LIMIT 1";

    $r = mysqli_query($dbc, $q);
    if (mysqli_affected_rows($dbc) === 1) {
      $body = sprintf(FORGOT_PASS_EMAIL_BODY, $p);
      mail($_POST['email'], FORGOT_PASS_EMAIL_SUBJ, $body, 'From: '.SITE_FROM_EMAIL);
      include('./includes/login/form.inc.php');
      include('./includes/start_main.inc.php');
      echo FORGOT_PASS_MSG;
      include('./includes/footer.inc.php');
      exit;
    } else {
      trigger_error(FORGOT_PASS_ERROR);
    }
  } else {
    $pass_errors['email'] = AUTH_EMAIL_NO_MATCH;
  }
}


        
