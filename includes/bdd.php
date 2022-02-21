<?php
function OpenDb()
{
   $dbhost = "localhost";
   $dbuser = "root";
   $dbpass = "root";
   $db = "loyaltycard";

   //$db = new PDO('mysql:host='.$dbhost.';dbname='.$db,$dbuser,$dbpass);
   $db = new PDO('mysql:host=localhost;port=8889;dbname= mysql ','root','root');
   return $db;
}
?>
