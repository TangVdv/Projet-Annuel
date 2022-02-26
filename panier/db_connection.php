<?php
  session_start();

  $db = new PDO('mysql:host=localhost;dbname=pa', 'root', 'root' ,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

 ?>
