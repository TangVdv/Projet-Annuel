<?php

if (isset($_POST["return_submit"])) {
  session_start();
  $UserId = $_SESSION['id_utilisateur'];
  $id_produit = $_GET['id'];
  include("ReturnModel.php");

  ReturnModel::ReturnProduct($UserId, $id_produit);
}

header('location:../index.php');


 ?>
