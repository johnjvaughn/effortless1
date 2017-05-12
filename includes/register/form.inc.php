<?php
  echo "<h1>$page_title</h1>";
?>
<p>
  Access to the site's content is available to registered users at a cost of $10.00 
  (US) per year. Use the form below to begin the registration process. 
  <strong>Note: All fields are required.</strong> After completing this form, 
  you'll be presented with the opportunity to securely pay for your yearly 
  subscription via <a href="http://www.paypal.com">PayPal</a>.
</p>

<?php 
  require_once('./includes/form_functions.inc.php');
  display_form_element();
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
  create_submit_btn('Next &rarr;');
?>
</form>
<a href='forgot_password.php'>Forgot Password?</a>
  