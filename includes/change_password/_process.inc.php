<?php
require('./includes/_auth_functions.inc.php');

if (!isset($pass_errors)) $pass_errors = array();
    
  if (!empty($_POST['current'])) {
    $current_pass = $_POST['current'];
  } else {
    $pass_errors['current'] = CHANGE_PASS_ENTER_CURRENT;
  }
  if (preg_match('/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*){6,}$/', $_POST['pass1']) ) {
    if ($_POST['pass1'] === $_POST['pass2']) {
      $new_pass = $_POST['pass1'];
    } else {
      $pass_errors['pass2'] = CHANGE_PASS_NO_MATCH;
    }
  } else {
    $pass_errors['pass1'] = CHANGE_PASS_ENTER_PASS;
  }
  
  if (empty($pass_errors)) {
    $uid = $_SESSION['user_id'];
    $q = "SELECT pass, IF(date_expires >= NOW(), true, false) " .
          "AS expired FROM users WHERE id='$uid'";
    $r = mysqli_query($dbc, $q);
    if (mysqli_num_rows($r) === 1) {
      $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
      if (my_password_verify($current_pass, $row['pass'])) {
        $q = "UPDATE users SET pass = '" . my_password_hash($new_pass) . "' WHERE id='$uid'";
        $r = mysqli_query($dbc, $q);
        if (mysqli_affected_rows($dbc) === 1) {
          echo "<div class='alert alert-success'>".CHANGE_PASS_SUCCESS."</div>";
          include('./includes/_start_main.inc.php');
          include('./includes/_footer.inc.php'); 
          exit();
        } else {
          trigger_error(CHANGE_PASS_ERROR);
        }
      } else {
        $pass_errors['current'] = CHANGE_PASS_WRONG_CURRENT;
      }
    } else {
      trigger_error(CHANGE_PASS_ERROR);
    }
  }

?>