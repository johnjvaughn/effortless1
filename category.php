<?php
require('./includes/config.inc.php');
require(MYSQL);

$cat_id = filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1));
if (!$cat_id) require(ERROR_AND_EXIT);

$q = "SELECT category FROM categories WHERE id = $cat_id";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) !== 1) require(ERROR_AND_EXIT);

list($page_title) = mysqli_fetch_array($r, MYSQLI_NUM);
$page_title = htmlspecialchars($page_title);
include('./includes/header.inc.php');
include('./includes/start_main.inc.php');
echo "<h1>$page_title</h1>";
user_status_notice();

$q = "SELECT id, title, description FROM pages WHERE categories_id = $cat_id " .
        "ORDER BY date_created DESC";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) > 0) {
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    echo "<div><h4><a href='page.php?id=" . $row['id'] . "'>" .
          htmlspecialchars($row['title']) . "</a></h4>";
    echo "<p>" . htmlspecialchars($row['description']) . "</p></div>";
  }
} else {
  echo '<p>There are currently no pages of content associated with this category. Please check back again!</p>';
}

include('./includes/footer.inc.php');


