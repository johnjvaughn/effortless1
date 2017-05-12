<?php
require('includes/config.inc.php');
require(MYSQL);

$page_title = "PDFs";
include('includes/header.inc.php');
include('includes/start_main.inc.php');
echo "<h1>PDF Guides</h1>";
user_status_notice();

$q = "SELECT tmp_name, title, description, size FROM pdfs ORDER BY date_created DESC";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) > 0) {
  while ($row = mysqli_fetch_assoc($r)) {
    $tmp_name = htmlspecialchars($row['tmp_name']);
    $title = htmlspecialchars($row['title']);
    $description = htmlspecialchars($row['description']);
    $size = (int)$row['size'];
    if (isset($_SESSION['user_not_expired'])) {
      $title_line = "<a href='view_pdf.php?id=$tmp_name' target='_blank'>$title</a> (${size}kb)";
    } else {
      $title_line = "$title (${size}kb)";
    }
    echo "<div><h4>$title_line</h4><p>$description</p></div>";
  }
} else {
  echo '<div class="alert alert-danger">' .
          'There are currently no PDFs available to view. Please check back again!</div>';
}
include('includes/footer.inc.php');



