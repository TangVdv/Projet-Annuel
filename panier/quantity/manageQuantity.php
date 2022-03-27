<?php
include("../../includes/bdd.php");
include("../itemModel.php");
session_start();
$UserId = $_SESSION['id_utilisateur'];

//Si l'utilisateur a appuyé sur le bouton +
if(isset($_POST['plus']) && isset($_POST['idProduit'])){
  ItemModel::AddQuantity($UserId);

//Si l'utilisateur a appuyé sur le bouton -
}elseif(isset($_POST['minus']) && isset($_POST['idProduit'])){
  ItemModel::MinusQuantity($UserId);
  //header('location:../panier.php?message=Quantité réduite avec succès&type=success');
}else{
  header('location:../panier.php?message=Une erreur est survenue&type=danger');
}


 ?>
