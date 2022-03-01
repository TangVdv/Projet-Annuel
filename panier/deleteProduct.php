<?php

include("db_connection.php");

if(isset($_POST['Suppr']) && isset($_POST['idProduit'])){
  $req = $db->prepare('DELETE FROM achete WHERE id_utilisateur = :id_utilisateur AND id_produit = :id_produit');
  $req->execute([
    "id_utilisateur" => "1",
    "id_produit" => htmlspecialchars($_POST["idProduit"])
  ]);
}

header('location:panier.php');
 ?>
