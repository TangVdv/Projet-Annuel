<?php

session_start();
$UserId = $_SESSION['id_utilisateur'];
include("../includes/bdd.php");
include("itemModel.php");


//Si l'utilisateur a appuyé sur le bouton Supprimer
if(isset($_POST['Suppr']) && isset($_POST['idProduit'])){
  ItemModel::DeleteProduct($UserId);
}

header('location:./');




 ?>
