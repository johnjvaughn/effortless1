<?php 
  require_once('./includes/form_functions.inc.php');
  display_form_element();
  create_form_input('current', 'password', 'Current Password', $pass_errors);
  create_form_input('pass1', 'password', 'New Password', $pass_errors);
?>
<span class='help-block'>
  Must be at least 6 characters long, with at least one 
  lowercase letter,one uppercase letter, and one number.
</span>
<?php
  create_form_input('pass2', 'password', 'Confirm New Password', $pass_errors);
  create_submit_btn('Change &rarr;');
?> 
</form>