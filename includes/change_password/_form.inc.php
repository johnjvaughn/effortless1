<form action='<?php echo basename($_SERVER['PHP_SELF']); ?>' method='post' accept-charset='utf-8'>
  <?php 
    if (!isset($pass_errors)) $pass_errors = array();
    require_once('./includes/form_functions.inc.php');
    create_form_input('current', 'password', 'Current Password', $pass_errors);
    create_form_input('pass1', 'password', 'New Password', $pass_errors);
  ?>
  <span class='help-block'>
    Must be at least 6 characters long, with at least one 
    lowercase letter,one uppercase letter, and one number.
  </span>
  <?php
    create_form_input('pass2', 'password', 'Confirm New Password', $pass_errors);
  ?>
  <input type='submit' name='submit_button' value='Change &rarr;' id='submit_button' class='btn btn-default' />
</form>