<?php

function create_form_input ($name, $type, $label = '', $errors = array(), $options = array(), $dbc=null, $query = '') {
  if (isset($_POST[$name])) {
    $value = $_POST[$name];
    $value = (get_magic_quotes_gpc()) ? stripslashes($value) : $value;
    $value = htmlspecialchars($value);
  } else {
    $value = '';
  }
  
  echo "<div class='form-group";
  $has_error = array_key_exists($name, $errors);
  echo $has_error ? " has-error'>" : "'>";
  $error_output_if_any = $has_error ? "<span class='help-block'>" . $errors[$name] . "</span>" : '';
  
  $option_output_if_any = '';
  if (!empty($options) and is_array($options)) {
    foreach ($options as $k => $v) {
      $option_output_if_any .= " $k='$v'";
    }
  }
          
  if (!empty($label)) echo "<label for='$name' class='control-label'>$label</label>";

  if (in_array($type, array('text', 'password', 'email'))) {
    echo "<input type='$type' name='$name' id='$name' class='form-control'";
    if ($value) echo " value = '$value'";
    echo $option_output_if_any . " />";
    echo $error_output_if_any;
  } else if ($type === 'textarea') {
    echo $error_output_if_any;
    echo "<textarea name='$name' id='$name' class='form-control'";
    echo $option_output_if_any . " />";
    echo $value;
    echo "</textarea>";
  } else if ($type === 'select') {
    echo "<select name='$name' class='form-control'>\n";
    echo "<option>Select One</option>\n";
    $r = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
      list($item_id, $item_name) = $row;
      #echo $row[0] . $row[1] . "<br>";
      $selected = ( $value == $item_id ) ? " selected='selected'" : "";
      echo "<option value='$item_id' $selected>$item_name</option>\n";
    }
    echo "</select>\n";
    echo $error_output_if_any;
  } else if ($type === 'file') {
    echo "<input type='$type' name='$name' id='$name' class='form-control'";
    echo $option_output_if_any . " />";
    echo $error_output_if_any;
    if ((!$has_error) and isset($_SESSION[$name]) and isset($_SESSION[$name]['file_name'])) {
      echo '<p class="lead">Currently: "' . $_SESSION[$name]['file_name'] . '"</p>';
    }
    if (!empty($query)) echo $query;  //anything extra for output
  }
  
  echo "</div>";
}

function create_submit_btn ($value = 'Submit', $name = 'submit_button', $class = 'btn btn-default', 
                            $options=array()) {
  $option_output_if_any = '';
  if (!empty($options) and is_array($options)) {
    foreach ($options as $k => $v) {
      $option_output_if_any .= " $k='$v'";
    }
  }echo "<input type='submit' name='$name' value='$value' id='$name' class='$class' $option_output_if_any />";
}

function display_form_element ($action='', $method='post', $options=array()) {
  $option_output_if_any = '';
  if (!empty($options) and is_array($options)) {
    foreach ($options as $k => $v) {
      $option_output_if_any .= " $k='$v'";
    }
  }
  if ((!$action) or ($action === 'self')) $action = basename($_SERVER['PHP_SELF']);
  if (!$method) $method = 'post';
  echo "<form action='$action' method='$method' accept-charset='utf-8' $option_output_if_any>";
}

