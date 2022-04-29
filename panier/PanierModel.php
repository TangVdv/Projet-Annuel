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
    include("../includes/bdd.php");
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
    //Passe tous les articles présents dans le panier de l'utilisateur en statut d'achat en cours
    $req = $db->prepare('UPDATE ACHETE
                          SET isBuying = 1
                          WHERE achete.id_utilisateur = :id_utilisateur');
    $req->execute([
      "id_utilisateur" => $UserId
    ]);
  }

  public static function ClearPanier($UserId){
    include("../includes/bdd.php");
    //Supprime tous les éléments du panier achetés par l'utilisateur
    $req = $db->prepare('DELETE FROM ACHETE
                          WHERE id_utilisateur = :id_utilisateur
                          AND isBuying = 1');
           $req->execute([
             "id_utilisateur" => $UserId
           ]);
  }

  public static function CancelPayment($UserId){
    include("../includes/bdd.php");
    //Passe tous les articles présents dans le panier de l'utilisateur en statut d'achat en cours
    $req = $db->prepare('UPDATE ACHETE
                          SET isBuying = 0
                          WHERE id_utilisateur = :id_utilisateur
                          AND isBuying = 1');
    $req->execute([
      "id_utilisateur" => $UserId
    ]);
  }

  public static function SaveBuyingHistory($prix_achat, $quantite, $id_utilisateur, $id_produit){
    include("../includes/bdd.php");
    //Sauvegarde les achats dans l'historique

    $req = $db->prepare('INSERT INTO HISTORIQUE_ACHAT(date_achat,	prix_achat, quantite, id_utilisateur, id_produit)
                          VALUES(:date_achat, :prix_achat, :quantite, :id_utilisateur, :id_produit)');
           $req->execute([
             "date_achat" => date("Y-m-d"),
             "prix_achat" => $prix_achat,
             "quantite" => $quantite,
             "id_utilisateur" => $id_utilisateur,
             "id_produit" => $id_produit
           ]);
  }

  public static function ApplyPayment($UserId){
    //Regroupe la sélection des informations produits et utilisateur ainsi que le remplissage de l'historique d'achat
    $finalReq = PanierModel::SelectProducts($UserId);
    $prix_total = 0;
    while ($row = $finalReq->fetch(PDO::FETCH_OBJ)){
      PanierModel::SaveBuyingHistory($row->prix, $row->quantite, $UserId, $row->id_produit);
      $prix_total += $row->prix * $row->quantite;
    }
    PanierModel::redeemPoints($UserId, $prix_total);

  }

  public static function redeemPoints($UserId, $prix_total){
    include("../includes/bdd.php");
    //Donne les points de fidélités à l'utilisateur
    $req = $db->prepare('UPDATE UTILISATEUR
                          SET pts_fidelite = pts_fidelite + :prix_total
                          WHERE id_utilisateur = :id_utilisateur');
           $req->execute([
             "prix_total" => $prix_total * 10,
             "id_utilisateur" => $UserId
           ]);
  }


  public static function compareLocalMoney($UserId, $prix_total){
    include("../includes/bdd.php");
    //Récupère le solde euro de l'utilisateur
    $req = $db->prepare('SELECT solde_euro
                          FROM UTILISATEUR
                          WHERE id_utilisateur = :id_utilisateur');
           $req->execute([
             "id_utilisateur" => $UserId
           ]);
    $solde_final = 0;
    while ($row = $req->fetch(PDO::FETCH_OBJ)){
      $solde_final = $row->solde_euro;
    }

    if($prix_total <= $solde_final){
      return 0;
    }else {
      return 1;
    }
  }

  public static function getTotalPrice($UserId){
    //Regroupe la sélection des informations produits et utilisateur ainsi que le remplissage de l'historique d'achat
    $finalReq = PanierModel::SelectProducts($UserId);
    $prix_total = 0;
    while ($row = $finalReq->fetch(PDO::FETCH_OBJ)){
      $prix_total += $row->prix * $row->quantite;
    }
    return $prix_total;
  }

  public static function updateLocalMoney($prix_total, $UserId){
    include("../includes/bdd.php");

    //Met à jour le solde euro
    $req = $db->prepare('UPDATE UTILISATEUR
                          SET solde_euro = solde_euro - :prix_total
                          WHERE id_utilisateur = :id_utilisateur');
           $req->execute([
             "prix_total" => $prix_total,
             "id_utilisateur" => $UserId
           ]);
  }

  public static function tryWithLocalMoney($UserId){
    $prix_total = PanierModel::getTotalPrice($UserId);
    $compareResult = PanierModel::compareLocalMoney($UserId, $prix_total);
    if($compareResult == 0){
      PanierModel::UpdateBuyingStatus($UserId);
      PanierModel::updateLocalMoney($prix_total, $UserId);
      //Regroupe la sélection des informations produits et utilisateur ainsi que le remplissage de l'historique d'achat
      $finalReq = PanierModel::SelectProducts($UserId);
      while ($row = $finalReq->fetch(PDO::FETCH_OBJ)){
        PanierModel::SaveBuyingHistory($row->prix, $row->quantite, $UserId, $row->id_produit);
      }
      //Supprime tous les éléments du panier achetés par l'utilisateur
      PanierModel::ClearPanier($UserId);

      return 0;
    }
    return 1;

  }

}


 ?>
