<?php
if (!isset($pass_errors)) $pass_errors = array();
require_once('./includes/form_functions.inc.php');
?>

<form action='<?php echo basename($_SERVER['PHP_SELF']); ?>' method='post' accept-charset='utf-8'>
  <fieldset>
    <?php
      echo "<legend>$page_title</legend>";
      echo "<p>".FORGOT_PASS_ENTER_EMAIL."</p>";
      if (array_key_exists('email', $pass_errors)) {
        echo "<div class='alert alert-danger'>" . $pass_errors['email'] . "</div>";
      }
      create_form_input('email', 'email', 'Email Address', $pass_errors);
    ?>
    <button type="submit" class="btn btn-default">Reset &rarr;</button>
  </fieldset>
</form>	