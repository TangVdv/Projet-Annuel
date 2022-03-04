<?php
include("../../includes/bdd.php");

//Si l'utilisateur a appuyé sur le bouton +
if(isset($_POST['plus']) && isset($_POST['idProduit'])){
  $reqPlus = $db->prepare('UPDATE ACHETE SET quantite = quantite + 1 WHERE id_utilisateur = :id_utilisateur AND id_produit = :id_produit');
  $reqPlus->execute([
    "id_utilisateur" => "1",
    //"id_utilisateur" => $_SESSION['id_utilisateur'],
    "id_produit" => htmlspecialchars($_POST["idProduit"])
  ]);
  header('location:../panier.php?message=Quantité augmentée avec succès&type=success');

//Si l'utilisateur a appuyé sur le bouton -
}elseif(isset($_POST['minus']) && isset($_POST['idProduit'])){
  //Vérifie si la quantite tombe à 0
  $reqCheck = $db->prepare('SELECT quantite FROM ACHETE WHERE id_utilisateur = :id_utilisateur AND id_produit = :id_produit');
  $reqCheck->execute([
    "id_utilisateur" => "1",
    //"id_utilisateur" => $_SESSION['id_utilisateur'],
    "id_produit" => htmlspecialchars($_POST["idProduit"])
  ]);
  $actualQuantity = $reqCheck->fetchColumn();
  if($actualQuantity < 2){
    //Supprime la ligne du produit dans le panier
    $reqSuppr = $db->prepare('DELETE FROM achete WHERE id_utilisateur = :id_utilisateur AND id_produit = :id_produit');
    $reqSuppr->execute([
      "id_utilisateur" => "1",
      //"id_utilisateur" => $_SESSION['id_utilisateur'],
      "id_produit" => htmlspecialchars($_POST["idProduit"])
    ]);
  }else {
    //Si la quantite ne tombe pas à 0
    $reqMinus = $db->prepare('UPDATE ACHETE SET quantite = quantite - 1 WHERE id_utilisateur = :id_utilisateur AND id_produit = :id_produit');
    $reqMinus->execute([
      "id_utilisateur" => "1",
      //"id_utilisateur" => $_SESSION['id_utilisateur'],
      "id_produit" => htmlspecialchars($_POST["idProduit"])
    ]);
  }
  header('location:../panier.php?message=Quantité réduite avec succès&type=success');

}else{
  header('location:../panier.php?message=Une erreur est survenue&type=danger');
}


 ?>
