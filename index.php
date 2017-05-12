<?php
require('./includes/config.inc.php');
require(MYSQL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  include('./includes/login/process.inc.php');
}
include('./includes/header.inc.php');
if (isset($_SESSION['username'])) {
  printf("<div class='alert alert-success'>".AUTH_LOGIN_SUCCESS."</div>", $_SESSION['username']);
} else {
  require("includes/login/form.inc.php");
}
include('./includes/start_main.inc.php');
?>

<h3>Welcome</h3>
<p class="lead">
  <?php echo HOME_PAGE_MSG; ?>
</p>
<?php
include('./includes/footer.inc.php');
?>
