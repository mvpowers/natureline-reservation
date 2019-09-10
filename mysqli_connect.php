<?php 

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'your_password_here');
define('DB_NAME', 'nature');

$dbcon = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
mysqli_set_charset($dbcon,'utf8');


?>