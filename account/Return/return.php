<?php

if (isset($_POST["return_submit"]) && isset($_POST["idProduit"]) && isset($_POST["idHistorique"])) {
  session_start();
  $UserId = $_SESSION['id_utilisateur'];
  $id_produit = $_POST['idProduit'];
  $id_historique = $_POST['idHistorique'];
  include("ReturnModel.php");
  
  ReturnModel::ReturnProduct($UserId, $id_produit, $id_historique);
}

header('location:../index.php');


 ?>
