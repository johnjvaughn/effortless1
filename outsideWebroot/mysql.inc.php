<?php

DEFINE('DB_USER', 'johnjva1_johnv');
DEFINE('DB_PASSWORD', 'Chopin1!');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'johnjva1_Effortless1');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_set_charset($dbc, 'utf8');

function escape_data ($data, $dbc) {
   if (get_magic_quotes_gpc()) $data = stripslashes($data);
   return mysqli_real_escape_string($dbc, trim($data));
}