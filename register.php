<?php
require('./includes/config.inc.php');
require(MYSQL);
$page_title = 'Register';
include('./includes/_header.inc.php');
include('./includes/_start_main.inc.php');

$reg_errors = array();

echo "<h1>$page_title</h1>";
require('./includes/register/_process.inc.php');
?>

<p>
  Access to the site's content is available to registered users at a cost of $10.00 
  (US) per year. Use the form below to begin the registration process. 
  <strong>Note: All fields are required.</strong> After completing this form, 
  you'll be presented with the opportunity to securely pay for your yearly 
  subscription via <a href="http://www.paypal.com">PayPal</a>.
</p>

<?php
echo "<h3>$page_title</h3>";
require('./includes/register/_form.inc.php');
include('./includes/_footer.inc.php');
?>
