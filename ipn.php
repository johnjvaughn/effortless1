<?php
require('./includes/config.inc.php');

if (($_SERVER['REQUEST_METHOD'] === 'POST') and isset($_POST['txn_id']) and 
        ($_POST['txn_type'] === 'web_accept')) {
  $body = '';
  foreach ($_POST as $k => $v) {
    $body .= "$k : $v\r\n";
  }
  #mail(CONTACT_EMAIL, "IPN POST received", $body, 'From: '.SITE_FROM_EMAIL);
      
  $ch = curl_init();
  curl_setopt_array($ch, array( 
                    CURLOPT_URL => PAYPAL_IPN_URL."/cgi-bin/webscr",
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => http_build_query(array('cmd' => '_notify-validate') + $_POST),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HEADER => false));
  $response = curl_exec($ch);
  $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  if (($status === 200) and ($response === 'VERIFIED')) {
    if ( isset($_POST['payment_status']) and ($_POST['payment_status'] === 'Completed') and
            ($_POST['receiver_email'] === PAYPAL_RECEIVER) and 
            (floatval($_POST['mc_gross']) == floatval(SUBSCRIPTION_COST)) and
            ($_POST['mc_currency'] === SUBSCRIPTION_CURRENCY) and (!empty($_POST['txn_id'])) ) {
      require(MYSQL);
      
      $txn_id = escape_data($_POST['txn_id'], $dbc);
      $q = "SELECT id FROM orders WHERE transaction_id = '$txn_id'";
      $r = mysqli_query($dbc, $q);
      if (mysqli_num_rows($r) === 0) {
        $uid = (isset($_POST['custom']) and is_int($_POST['custom'])) ? (int)$_POST['custom'] : 0;
        $status = escape_data($_POST['payment_status'], $dbc);
        $amount = (int)(100 * floatval($_POST['mc_gross']));
        $q = "INSERT INTO orders (users_id, transaction_id, payment_status, payment_amount) " . 
             "VALUES ($uid, '$txn_id', '$status', $amount)";
        $r = mysqli_query($dbc, $q);
        if (mysqli_affected_rows($dbc) === 1) {
          if ($uid > 0) {
            $q = "UPDATE users SET date_expires = IF(date_expires > NOW(), " .
                 "ADDDATE(date_expires, INTERVAL 1 YEAR), ADDDATE(NOW(), INTERVAL 1 YEAR)), " .
                 "date_modified = NOW() WHERE id='$uid'";
            $r = mysqli_query($dbc, $q);
            if (mysqli_affected_rows($dbc) !== 1) {
              trigger_error("The user's expiration date could not be updated!");
            }
          }
        } else {
          trigger_error("The transaction could not be stored in the orders table!");
        }
      } else {
        trigger_error("The order has already been stored; nothing to do!");
      }
    } else {
      trigger_error("The right values don't exist in !");
    }
  } else {
    trigger_error("Bad response from IPN receipt");
  }
} else {
  echo "Nothing to do.";
}

