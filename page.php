<?php
require('./includes/config.inc.php');
require(MYSQL);

$page_id = filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1));
if (!$page_id) require(ERROR_PAGE_EXIT);

$q = "SELECT title, description, content FROM pages WHERE id = $page_id";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) !== 1) require(ERROR_PAGE_EXIT);

$row = mysqli_fetch_assoc($r);
$page_title = htmlspecialchars($row['title']);
$description = htmlspecialchars($row['description']);
include('./includes/header.inc.php');
include('./includes/start_main.inc.php');
echo "<h1>$page_title</h1>";

if (isset($_SESSION['user_not_expired'])) { //valid user
  echo "<div>" . $row['content'] . "</div>";
} else {
  user_status_notice();
  echo "<div>$description</div>";
}

include('./includes/footer.inc.php');


