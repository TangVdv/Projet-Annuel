<?php
include("../db_connection.php");

if(isset($_POST['plus']) && isset($_POST['idProduit'])){
  $req = $db->prepare('UPDATE ACHETE SET quantite = quantite + 1 WHERE id_utilisateur = :id_utilisateur AND id_produit = :id_produit');
  $req->execute([
    "id_utilisateur" => "1",
    "id_produit" => htmlspecialchars($_POST["idProduit"])
  ]);
  header('location:../panier.php?message=Quantité augmentée avec succès&type=success');
}

if(isset($_POST['minus']) && isset($_POST['idProduit'])){
  $req = $db->prepare('UPDATE ACHETE SET quantite = quantite - 1 WHERE id_utilisateur = :id_utilisateur AND id_produit = :id_produit');
  $req->execute([
    "id_utilisateur" => "1",
    "id_produit" => htmlspecialchars($_POST["idProduit"])
  ]);
  header('location:../panier.php?message=Quantité réduite avec succès&type=success');
}

header('location:../panier.php?message=Une erreur est survenue&type=danger');






 ?>
