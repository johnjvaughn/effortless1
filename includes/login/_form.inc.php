<?php
if (!isset($login_errors)) $login_errors = array();
require('./includes/form_functions.inc.php');
?>

<form action='./index.php' method='post' accept-charset='utf-8'>
  <fieldset>
    <legend>Login</legend>
    <?php
      if (array_key_exists('login', $login_errors)) {
        echo "<div class='alert alert-danger'>" . $login_errors['login'] . "</div>";
      }
      create_form_input('email', 'email', 'Email Address', $login_errors);
      create_form_input('pass', 'password', 'Password', $login_errors);
    ?>
    <a href="forgot_password.php">Forgot Password?</a>
    <button type="submit" class="btn btn-default" style="width: 50%; float:right">Login &rarr;</button>
    
    
  </fieldset>
</form>	