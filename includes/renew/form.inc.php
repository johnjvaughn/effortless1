<?php
  $uid = $_SESSION['user_id'];
  $q = "SELECT email, date_expires FROM users WHERE id = '$uid'";
  $r = mysqli_query($dbc, $q);
  if (mysqli_num_rows($r) !== 1) {
    include(ERROR_AND_EXIT);
  }
  $row = mysqli_fetch_assoc($r);
  $e = $row['email'];
  
  echo "<h1>$page_title</h1>";
?>
<p><?php
  if (isset($_SESSION['user_not_expired'])) {
    $date_expires = date("M j, Y", strtotime($row['date_expires']));
    echo "Thank you for your interest in renewing your account! " . 
         "Your account is paid for through $date_expires. Renewing will add another " .
         "year to that.";
  } else {
    $date_will_expire = date("M, j, Y", strtotime("+1 year"));
    echo "Thank you for your interest in reactivating your account! " . 
         "This will pay for your account through $date_will_expire.";
  }
  ?></p>
<p>
  The cost is $10 (US) to activate for a year. To complete the process, please now 
  click the button below so that you may pay via PayPal. 
  <strong>
    Note: After renewing your membership at PayPal, you must logout and 
    log back in at this site in order to process the renewal.
  </strong>
</p>
<?php
  include('./includes/renew/paypal_form.inc.php');
  include('./includes/footer.inc.php'); 
?>
      