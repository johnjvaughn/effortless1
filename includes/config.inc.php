<?php
include './includes/language.inc.php';

if (!defined('LIVE')) define('LIVE', false);
//set this email address
define('CONTACT_EMAIL', 'johnjvaughn@gmail.com');
//outgoing email is sent FROM the next address
define('SITE_FROM_EMAIL', 'admin@localhost');
//set this to root home directory
define('BASE_URI', '/home3/johnjva1/');
//set this to base url of store
define('BASE_URL', 'johnjvaughn.com/Effortless1/');
define('BASE_URL_SECURE', 'https://cx105.justhost.com/~johnjva1/Effortless1/');
//set this to file location of mysql.inc.php file
define('MYSQL', BASE_URI . 'Effortless1/mysql.inc.php');
define('PDFS_DIR', BASE_URI . 'Effortless1/pdfs/');
define('MESSAGE_AND_EXIT', './includes/message_and_exit.inc.php');
define('ERROR_AND_EXIT', './includes/error_and_exit.inc.php');

if (LIVE) {
  define('PAYPAL_URL', "https://www.sandbox.paypal.com"); #www.paypal.com"); needs to be this eventually
  define('PAYPAL_IPN_URL', "https://ipnpb.sandbox.paypal.com"); #ipnpb.paypal.com");  needs to be this
  define('PAYPAL_RECEIVER', "john@johnjvaughn.com");
} else {
  define('PAYPAL_URL', "https://www.sandbox.paypal.com");
  define('PAYPAL_IPN_URL', "https://ipnpb.sandbox.paypal.com");
  define('PAYPAL_RECEIVER', "john-facilitator@johnjvaughn.com");
}
define('SUBSCRIPTION_COST', 10.00);
define('SUBSCRIPTION_CURRENCY', 'USD');

if (CRYPT_SALT_LENGTH >= 12) {
  define('CRYPT_SALT', 'asle3DlksdK1');
} else {
  define('CRYPT_SALT', '8U');
}
define('ALLOWED_TAGS_IN_CONTENT', '<div><p><span><br><a><img><h1><h2><h3><h4><ul><ol><li><blockquote>');


session_start();

function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {
  $message = "An error occurred in script '$e_file' on line $e_line:\n$e_message\n";
  $message .= "<pre>" .print_r(debug_backtrace(), 1) . "</pre>\n";
  if (LIVE) {
    error_log($message, 1, CONTACT_EMAIL, 'From:'.SITE_FROM_EMAIL);
    if ($e_number != E_NOTICE) {
      echo '<div class="alert alert-danger">A system error occurred. We apologize for the inconvenience.</div>';
    }
  } else {
    echo '<div class="alert alert-danger">' . nl2br($message) . '</div>';
    mail(CONTACT_EMAIL, BASE_URL." Error", $message, 'From: '.SITE_FROM_EMAIL);
  }
  
  return true;
}

set_error_handler('my_error_handler');

function redirect_invalid_user ($check = 'user_id', $destination = 'index.php', $protocol = 'http://') {
  if (!isset($_SESSION[$check])) {
    if (headers_sent()) {
      include_once('./includes/header.inc.php');
      include_once('./includes/start_main.inc.php');
      trigger_error("You do not have permission to access this page. Please login and try again.");
      include_once('./includes/footer.inc.php');
    } else {
      $url = $protocol . BASE_URL . $destination;
      header("Location: $url");
      exit;
    }
  }
}

function user_status_notice () {
  if (isset($_SESSION['user_not_expired'])) { //valid user
    //a-ok, no message necessary
  } else if (isset($_SESSION['user_id'])) {   //valid user but expired
    echo "<div class='alert'>" . EXPIRED_ACCT_MSG . "</div>";
  } else {                                    //not logged in
    echo "<div class='alert'>" . NO_LOGIN_ACCT_MSG . "</div>";
  }
}


