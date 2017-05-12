<?php

$t = escape_data(strip_tags($_POST['title']), $dbc);
if (empty($t))  $add_page_errors['title'] = "Please enter the title!";

$cat = filter_var($_POST['category'], FILTER_VALIDATE_INT, array('min_range' => 1));
$newcat = escape_data(strip_tags($_POST['new_category']), $dbc);
if ($cat and !empty($newcat)) {
  $add_page_errors['category'] = "Either select an existing category OR type a new one.";
} else if (!$cat and empty($newcat)) {
  $add_page_errors['category'] = "Please select or add a category!";
} else if (!$cat and !empty($newcat)) {
  $q = "SELECT id FROM categories WHERE category = '$newcat'";
  $r = mysqli_query($dbc, $q);
  if (mysqli_num_rows($r) === 1) {
    $row = mysqli_fetch_array($r);
    if ($row[0]) $cat = $row[0];
  } 
  if (!$cat) {
    $q = "INSERT INTO categories (category) VALUES ('$newcat')";
    $r = mysqli_query($dbc, $q);
    if (mysqli_affected_rows($dbc) === 1) {
      $cat = mysqli_insert_id($dbc);
    } else {
      trigger_error("Unable to add new category due to system error.");
    }
  }
}

$d = escape_data(strip_tags($_POST['description']), $dbc);
if (empty($d))  $add_page_errors['description'] = "Please enter the description!";

$c = escape_data(strip_tags($_POST['content'], ALLOWED_TAGS_IN_CONTENT), $dbc);
if (empty($c))  $add_page_errors['content'] = 'Please enter the content!';

if (empty($add_page_errors)) {
  $q = "INSERT INTO pages (categories_id, title, description, content) VALUES ($cat, '$t', '$d', '$c')";
  $r = mysqli_query($dbc, $q);
  if (mysqli_affected_rows($dbc) === 1) {
    echo "<div class='alert alert-success'><h3>The page has been added!</h3></div>";
    $_POST = array();
  } else {
    trigger_error("The page could not be added due to a system error. We apologize for any inconvenience.");
  }
}
