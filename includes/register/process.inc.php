<?php
require('./includes/auth_functions.inc.php');

if (preg_match('/^[A-Z \'.-]{2,45}$/i', $_POST['first_name'])) {
  $fn = escape_data($_POST['first_name'], $dbc);
} else {
  $reg_errors['first_name'] = REG_ENTER_FIRSTNAME;
}
if (preg_match('/^[A-Z \'.-]{2,45}$/i', $_POST['last_name'])) {
  $ln = escape_data($_POST['last_name'], $dbc);
} else {
  $reg_errors['last_name'] = REG_ENTER_LASTNAME;
}
if (preg_match('/^[A-Z0-9]{2,45}$/i', $_POST['username'])) {
  $u = escape_data($_POST['username'], $dbc);
} else {
  $reg_errors['username'] = REG_ENTER_USERNAME;
}
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === $_POST['email']) {
  $e = escape_data($_POST['email'], $dbc);
} else {
  $reg_errors['email'] = REG_ENTER_EMAIL;
}
if (preg_match('/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*){6,}$/', $_POST['pass1']) ) {
  if ($_POST['pass1'] === $_POST['pass2']) {
    $p = $_POST['pass1'];
  } else {
    $reg_errors['pass2'] = REG_PASS_NO_MATCH;
  }
} else {
  $reg_errors['pass1'] = REG_ENTER_PASS;
}

if (empty($reg_errors)) {
  $q = "SELECT email, username FROM users WHERE email='$e' OR username='$u'";
  $r = mysqli_query($dbc, $q);
  $rows = mysqli_num_rows($r);
  if ($rows === 0) {
    $q = "INSERT INTO users (username, email, pass, first_name, last_name, date_expires) " .
         "VALUES ('$u', '$e', '"  .  my_password_hash($p) .  
         "', '$fn', '$ln', SUBDATE(NOW(), INTERVAL 1 DAY) )";
    $r = mysqli_query($dbc, $q);
    if (mysqli_affected_rows($dbc) === 1) {
      $uid = mysqli_insert_id($dbc);
      echo "<div class='alert alert-success'>".REG_SUCCESS."</div>";
      include('includes/register/paypal_form.inc.php');
      mail($_POST['email'], REG_EMAIL_SUBJ, REG_EMAIL_BODY, 'From: '.SITE_FROM_EMAIL);
      include('./includes/footer.inc.php'); 
      exit();
    } else {
      trigger_error(REG_ERROR);
    }
  } else {
    if ($rows === 2) { // Both are taken.
      $reg_errors['email'] = REG_EMAIL_TAKEN;			
      $reg_errors['username'] = REG_USERNAME_TAKEN;			
    } else {
      $row = mysqli_fetch_array($r, MYSQLI_NUM);
      if( ($row[0] === $_POST['email']) && ($row[1] === $_POST['username'])) { // Both match.
        $reg_errors['email'] = REG_EMAIL_TAKEN;	
        $reg_errors['username'] = REG_USERNAME_TAKEN;
      } elseif ($row[0] === $_POST['email']) { // Email match.
        $reg_errors['email'] = REG_EMAIL_TAKEN;						
      } elseif ($row[1] === $_POST['username']) { // Username match.
        $reg_errors['username'] = REG_USERNAME_TAKEN;			
      }
    }
  }
}
?>