<?php

class PanierModel{

  public static function SelectProducts($UserId){
    include("../includes/bdd.php");
    //Sélectionne tous les produits dans le panier de l'utilisateur
    $req = $db->prepare('SELECT produit.id_produit, image, nom, prix, reduction, quantite
                          FROM PRODUIT
                          INNER JOIN ACHETE ON produit.id_produit = achete.id_produit
                          WHERE achete.id_utilisateur = :id_utilisateur');
           $req->execute([
             "id_utilisateur" => $UserId
           ]);
    return $req;
  }

  public static function VerifBuying($UserId){
    include("../../includes/bdd.php");
    $req = $db->prepare('SELECT COUNT(*) AS total
                          FROM ACHETE
                          WHERE id_utilisateur = :id_utilisateur
                          AND isBuying = 1');
           $req->execute([
             "id_utilisateur" => $UserId
           ]);
           $row = $req->fetch(PDO::FETCH_OBJ);
    return $row->total;
  }

  public static function UpdateBuyingStatus($UserId){
    include("../includes/bdd.php");
    $req = $db->prepare('UPDATE ACHETE
                          SET isBuying = 1
                          WHERE achete.id_utilisateur = :id_utilisateur');
           $req->execute([
             "id_utilisateur" => $UserId
           ]);
  }

}


 ?>
