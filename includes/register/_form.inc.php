<form action='<?php echo basename($_SERVER['PHP_SELF']); ?>' method='post' accept-charset='utf-8'>
  <?php 
    require_once('./includes/form_functions.inc.php');
    create_form_input('first_name', 'text', 'First Name', $reg_errors);
    create_form_input('last_name', 'text', 'Last Name', $reg_errors);
    create_form_input('username', 'text', 'Desired Username', $reg_errors);
  ?>
  <span class='help-block'>Only letters and numbers are allowed.</span>
  <?php
    create_form_input('email', 'email', 'Email Address', $reg_errors);
    create_form_input('pass1', 'password', 'Password', $reg_errors);
  ?>
  <span class='help-block'>
    Must be at least 6 characters long, with at least one 
    lowercase letter,one uppercase letter, and one number.
  </span>
  <?php
    create_form_input('pass2', 'password', 'Confirm Password', $reg_errors);
  ?>
  <input type='submit' name='submit_button' value='Next &rarr;' id='submit_button' class='btn btn-default' />
</form>