<?php

if (isset($_POST["delete_submit"])) {
  session_start();
  $UserId = $_SESSION['id_utilisateur'];
  include("itemModel.php");

  ItemModel::DeleteProduct($UserId);
}

header('location:./');




 ?>
