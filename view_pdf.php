<?php
require('includes/config.inc.php');
redirect_invalid_user('user_not_expired', 'pdfs.php');
require(MYSQL);

$valid = false;

if (isset($_GET['id']) && (strlen($_GET['id']) === 63) && (substr($_GET['id'], 0, 1) !== '.') ) {
  $file = PDFS_DIR . $_GET['id'];
  if (file_exists($file) && (is_file($file)) ) {
    $tmp_name = escape_data($_GET['id'], $dbc);
    $q = "SELECT id, title, description, file_name FROM pdfs WHERE tmp_name = '$tmp_name'";
    $r = mysqli_query($dbc, $q);
    if (mysqli_num_rows($r) == 1) {
      $row = mysqli_fetch_assoc($r);
      $valid = true;
    }
  }
}

if ($valid) {
  header('Content-type:application/pdf');
  header('Content-Disposition:inline;filename="' . $row['file_name'] . '"');
  $fs = filesize($file);
  header("Content-Length:$fs\n");
  readfile($file);
  exit();
}
