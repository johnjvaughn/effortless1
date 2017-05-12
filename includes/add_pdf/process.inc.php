<?php

$t = escape_data(strip_tags($_POST['title']), $dbc);
if (empty($t))  $add_pdf_errors['title'] = "Please enter the title!";
$d = escape_data(strip_tags($_POST['description']), $dbc);
if (empty($d))  $add_pdf_errors['description'] = "Please enter the description!";

if (is_uploaded_file($_FILES['pdf']['tmp_name']) && ($_FILES['pdf']['error'] === UPLOAD_ERR_OK)) {
  $file = $_FILES['pdf'];
  $size = round($file['size']/1024);
  $add_pdf_errors['pdf'] = ($size > 5120) ? "The uploaded file is too large. " : '';
  if (function_exists("finfo_open")) {
//echo "STOP1: finfo_open exists";
//include('./includes/footer.inc.php');
//exit;
    $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
    if (finfo_file($fileinfo, $file['tmp_name']) !== 'application/pdf') {
      $add_pdf_errors['pdf'] .= "The uploaded file was not a PDF. ";
    }
    finfo_close($fileinfo);
  } else {
//echo "STOP2: finfo_open doesnt exist";
//include('./includes/footer.inc.php');
//exit;
    if (strtolower(substr($file['name'], -4)) !== '.pdf') {
      $add_pdf_errors['pdf'] .= "The uploaded file was not a PDF. ";
    }
  }
  
  if (!$add_pdf_errors['pdf']) {
    unset($add_pdf_errors['pdf']);
    $tmp_name = sha1($file['name']) . uniqid('',true);
    $dest = PDFS_DIR . $tmp_name . '_tmp';
    if (move_uploaded_file($file['tmp_name'], $dest)) {
      $_SESSION['pdf']['tmp_name'] = $tmp_name;
      $_SESSION['pdf']['size'] = $size;
      $_SESSION['pdf']['file_name'] = $file['name'];
      echo '<div class="alert alert-success"><h3>The file has been uploaded!</h3></div>';
    } else {
      trigger_error('The file could not be moved.');
      unlink($file['tmp_name']);
    }
  }
} elseif (!isset($_SESSION['pdf'])) {
  switch ($_FILES['pdf']['error']) {
    case 1:
    case 2:
      $add_pdf_errors['pdf'] = 'The uploaded file was too large.';
      break;
    case 3:
      $add_pdf_errors['pdf'] = 'The file was only partially uploaded.';
      break;
    case 6:
    case 7:
    case 8:
      $add_pdf_errors['pdf'] = 'The file could not be uploaded due to a system error.';
      break;
    case 4:
    default:
      $add_pdf_errors['pdf'] = 'No file was uploaded.';
      break;
  }
}
//if (empty($add_pdf_errors)) {
//  echo "<h1>No errors!</h1>";
//} else {
//  echo "ERRORS: "; 
//  print_r($add_pdf_errors);
//}
//include('./includes/footer.inc.php');
//exit;
  
if (empty($add_pdf_errors)) {
  $fn = escape_data($_SESSION['pdf']['file_name'], $dbc);
  $tmp_name = escape_data($_SESSION['pdf']['tmp_name'], $dbc);
  $size = (int) $_SESSION['pdf']['size'];
  $q = "INSERT INTO pdfs (title, description, tmp_name, file_name, size) " .
       "VALUES ('$t', '$d', '$tmp_name', '$fn', $size)";
  $r = mysqli_query($dbc, $q);
  if (mysqli_affected_rows($dbc) === 1) {
    $original =  PDFS_DIR . $tmp_name . '_tmp';
    $dest =  PDFS_DIR . $tmp_name;
    rename($original, $dest);
    echo "<div class='alert alert-success'><h3>The PDF has been added!</h3></div>";
    $_POST = $_FILES = array();
    unset($file, $_SESSION['pdf']);
  } else {
    trigger_error("The PDF could not be added due to a system error. We apologize for any inconvenience.");
    unlink($dest);
  }
}
