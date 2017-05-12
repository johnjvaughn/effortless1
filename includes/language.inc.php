<?php

//home page
define('HOME_PAGE_MSG', "Welcome to Knowledge is Power, a site dedicated to keeping you " .
                        "up-to-date on the Web security and programming information you need to know. " .
                        "Blah, blah, blah. Yadda, yadda, yadda");
//register
define('REG_SUCCESS',  "<h3>Thanks!</h3><p>Thank you for registering! " . 
                            "To complete the process, please now click the button below so that you may pay " .
                            "for your site access via PayPal. The cost is $10 (US) per year. " . 
                            "<strong>Note: When you complete your payment at PayPal, please click the button " . 
                            "to return to this site.</strong></p>");
define('REG_EMAIL_BODY', "Thank you for registering at <whatever site>. Blah. Blah. Blah.\n\n");
define('REG_EMAIL_SUBJ', 'Registration Confirmation');
define('REG_EMAIL_TAKEN', 'This email address has already been registered. ' . 
                              'If you have forgotten your password, use the link at ' .
                              'left to have your password sent to you.');
define('REG_USERNAME_TAKEN', 'This username has already been registered. Please try another.');
define('REG_ERROR', 'You could not be registered due to a system error. ' .
                    'We apologize for any inconvenience. We will correct the error ASAP.');
define('REG_ENTER_FIRSTNAME', 'Please enter your first name!');
define('REG_ENTER_LASTNAME', 'Please enter your last name!');
define('REG_ENTER_USERNAME', 'Please enter a desired username using only letters and numbers!');
define('REG_ENTER_EMAIL', 'Please enter a valid email address!');
define('REG_ENTER_PASS', 'Please enter a valid password!');
define('REG_PASS_NO_MATCH', 'Your password did not match the confirmed password!');
define('THANKS_MSG', "<h1>Thank You!</h1>" . 
                      "<p>You may now access all of the site's content for the next year! " .
                      "<strong>Note: Your access to the site will automatically be renewed " .
                      "via PayPal each year. To disable this feature, or to cancel " .
                      "your account, see the \"My preapproved purchases\" section of your " .
                      "PayPal Profile page.</strong></p>");
define('CANCEL_MSG', "<h1>Oops!</h1>" . 
                     "<p>The payment through PayPal was not completed. You now have a valid " .
                     "membership at this site, but you will not be able to view any content " .
                     "until you complete the PayPal transaction. You can do so by clicking " .
                     "on the Renew link after logging in.</p>");

//authorization
define('AUTH_ENTER_EMAIL', 'Please enter a valid email address!');
define('AUTH_ENTER_PASS', 'Please enter your password!');
define('AUTH_LOGIN_NO_MATCH', 'The email address and password do not match those on file.');
define('AUTH_LOGIN_SUCCESS', 'Hello, %s!');
define('AUTH_LOGOUT_SUCCESS', 'Thank you for visiting. You are now logged out. Please come back soon!');
define('AUTH_EMAIL_NO_MATCH', 'The submitted email address does not match any of those on file.');

define('FORGOT_PASS_EMAIL_BODY', "Your password to log into <whatever site> has been temporarily changed to '%s'. " .
                                 "Please log in using that password and this email address. " .
                                 "Then you may change your password to something more familiar.");
define('FORGOT_PASS_EMAIL_SUBJ', "Your temporary password");
define('FORGOT_PASS_MSG', '<h3>Your password has been changed.</h3>' . 
                          '<p>You will receive the new, temporary password via email. ' .
                          'Once you have logged in with this new password, you may ' .
                          'change it by clicking on the "Change Password" link.</p>');
define('FORGOT_PASS_ERROR', 'Your password could not be changed due to a system error. ' .
                            'We apologize for any inconvenience. We will correct the error ASAP.');
define('FORGOT_PASS_ENTER_EMAIL', "Enter your email address below to reset your password.");

define('CHANGE_PASS_WRONG_CURRENT', "The current password you entered does not match our records.");
define('CHANGE_PASS_ERROR', 'Your password could not be changed due to a system error. ' .
                            'We apologize for any inconvenience. We will correct the error ASAP.');
define('CHANGE_PASS_SUCCESS', "Your password has been changed.");
define('CHANGE_PASS_ENTER_CURRENT', 'Please enter your current password!');
define('CHANGE_PASS_ENTER_PASS', 'Please enter a valid new password!');
define('CHANGE_PASS_NO_MATCH', 'Your new password did not match the confirmed new password!');

define('EXPIRED_ACCT_MSG', "<h4>Expired Account</h4>
                            Thank you for your interest in this content. Unfortunately your account has expired.
                            Please <a href='renew.php'>renew your account</a> in order to access site content.");
define('NO_LOGIN_ACCT_MSG', "<h4>Please login or register</h4>
                             Thank you for your interest in this content.
                             You must be logged in as a registered user to view site content.");
