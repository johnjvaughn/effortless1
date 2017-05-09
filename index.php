<?php
require('./includes/config.inc.php');
require(MYSQL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  include('./includes/login/_process.inc.php');
}
include('./includes/_header.inc.php');
if (isset($_SESSION['user_id'])) {
  printf("<div class='alert alert-success'>".AUTH_LOGIN_SUCCESS."</div>", $_SESSION['username']);
} else {
  require("includes/login/_form.inc.php");
}
include('./includes/_start_main.inc.php');
?>

<h3>Welcome</h3>
<p class="lead">
  <?php echo HOME_PAGE_MSG; ?>
</p>

<?php
include('./includes/_footer.inc.php');
?>
