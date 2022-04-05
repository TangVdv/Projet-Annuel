<?php
include("PanierModel.php");

session_start();
$current_UID = $_SESSION["id_utilisateur"];

PanierModel::ApplyPayment($current_UID);
//Supprime tous les éléments du panier achetés par l'utilisateur
PanierModel::ClearPanier($current_UID);

header("location:panier.php?message=Achat effectué avec succès");

 ?>
