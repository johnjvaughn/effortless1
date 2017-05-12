<?php
  require_once('./includes/form_functions.inc.php');
  display_form_element();
  echo "<fieldset>";
  echo "<legend>$page_title</legend>";
  echo "<p>".FORGOT_PASS_ENTER_EMAIL."</p>";
  if (array_key_exists('email', $pass_errors)) {
    echo "<div class='alert alert-danger'>" . $pass_errors['email'] . "</div>";
  }
  create_form_input('email', 'email', 'Email Address', $pass_errors);
  create_submit_btn('Reset &rarr;');
?>
  </fieldset>
</form>	