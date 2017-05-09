<?php

function create_form_input ($name, $type, $label = '', $errors = array(), $options = array()) {
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
    echo $option_output_if_any . ">";
    echo $value;
    echo "</textarea>";
  }
  
  echo "</div>";
}

