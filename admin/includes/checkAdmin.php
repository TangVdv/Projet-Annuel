<?php
if(!isset($_SESSION['admin'])) session_start();

if ($_SESSION['admin'] == 0) {
  header("location:/");
}
 ?>
