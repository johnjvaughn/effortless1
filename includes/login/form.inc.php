<?php
if (!isset($login_errors)) $login_errors = array();
require('./includes/form_functions.inc.php');
display_form_element('index.php');
?>

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
<?php create_submit_btn('Login &rarr;', 'submit_button', 'btn btn-default', 
                        array('style' => "width: 50%; float:right")); ?>

</fieldset>
</form>	