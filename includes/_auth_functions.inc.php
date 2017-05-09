<?php

function my_password_hash ($word) {
  $hash = '';
  if (function_exists('password_hash')) {
    $hash = password_hash($word, PASSWORD_BCRYPT);
  } else if (function_exists('crypt')) {
    $hash = crypt($word, CRYPT_SALT);
  }
  if ($hash) return $hash;
  trigger_error('Error in my_password_hash function');
}

function my_password_verify ($word, $hash) {
  if (function_exists('password_verify')) {
    return password_verify($word, $hash);
  } else if (function_exists('crypt')) {
    return(crypt($word, CRYPT_SALT) === $hash);
  }
  trigger_error('Error in my_password_verify function');
  return false;
}


