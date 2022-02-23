<?php
  session_start();
  
  $db = new PDO('mysql:host=localhost;dbname=pa2', 'root', 'root' ,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

 ?>
