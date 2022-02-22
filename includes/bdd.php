<?php
function OpenDb(){
   $dbhost = "localhost";
   $dbuser = "root";
   $dbpass = "root";
   $dbname = "loyaltycard";
   $port = 3306;

   $db = new PDO('mysql:host='.$dbhost.';port='.$port.';dbname='.$dbname,$dbuser,$dbpass);
   return $db;
}

function SelectAll($table_name, $db){
  $req = $db->query('SELECT * FROM '.$table_name);
  return $req;
}
?>
