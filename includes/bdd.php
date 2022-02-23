<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "loyaltycard";
$port = 3306;

$db = new PDO('mysql:host='.$dbhost.';port='.$port.';dbname='.$dbname,$dbuser,$dbpass);
?>
