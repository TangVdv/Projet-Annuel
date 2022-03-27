<?php


class ItemModel{

  public static function DeleteProduct($UId){
    include("../includes/bdd.php");
    $req = $db->prepare('DELETE FROM achete WHERE id_utilisateur = :id_utilisateur AND id_produit = :id_produit');
    $req->execute([
      "id_utilisateur" => $UId,
      "id_produit" => htmlspecialchars($_POST["idProduit"])
    ]);
  }


  public static function AddQuantity($UId){
    include("../../includes/bdd.php");
    $reqPlus = $db->prepare('UPDATE ACHETE SET quantite = quantite + 1 WHERE id_utilisateur = :id_utilisateur AND id_produit = :id_produit');
    $reqPlus->execute([
      "id_utilisateur" => $UId,
      "id_produit" => htmlspecialchars($_POST["idProduit"])
    ]);
    header('location:../panier.php?message=Quantité augmentée avec succès&type=success');
  }

  public static function MinusQuantity($UserId){
    include("../../includes/bdd.php");
    ItemModel::GetQuantity($UserId);

    if($actualQuantity < 2){
      //Supprime la ligne du produit dans le panier
      ItemModel::DeleteProduct($UserId);
    }else {
      ItemModel::LowerQuantity($UId);
    }
  }


  public static function GetQuantity($UId){
    //Vérifie si la quantite tombe à 0
    include("../../includes/bdd.php");
    $reqCheck = $db->prepare('SELECT quantite FROM ACHETE WHERE id_utilisateur = :id_utilisateur AND id_produit = :id_produit');
    $reqCheck->execute([
      "id_utilisateur" => $UId,
      "id_produit" => htmlspecialchars($_POST["idProduit"])
    ]);
    $actualQuantity = $reqCheck->fetchColumn();
  }


  public static function LowerQuantity($UId){
    //Si la quantite ne tombe pas à 0
    include("../../includes/bdd.php");
    $reqMinus = $db->prepare('UPDATE ACHETE SET quantite = quantite - 1 WHERE id_utilisateur = :id_utilisateur AND id_produit = :id_produit');
    $reqMinus->execute([
      "id_utilisateur" => $UId,
      "id_produit" => htmlspecialchars($_POST["idProduit"])
    ]);
    header('location:../panier.php?message=Quantité réduite avec succès&type=success');
  }

}

 ?>
