<?php

class ReturnModel{
  public static function GetPrice($UserId, $id_produit, $id_historique){
    include("../../includes/bdd.php");
    //Renvoie le prix total du produit
    $req = $db->prepare('SELECT prix_achat, quantite
                          FROM HISTORIQUE_ACHAT
                          WHERE id_utilisateur = :id_utilisateur
                          AND id_produit = :id_produit
                          AND id_historique = :id_historique');
    $req->execute([
      "id_utilisateur" => $UserId,
      "id_produit" => $id_produit,
      "id_historique" => $id_historique
    ]);
    
    $row = $req->fetch(PDO::FETCH_OBJ);
    return $row->prix_achat * $row->quantite;
  }

  public static function UpdateHistory($UserId, $id_produit, $id_historique){
    include("../../includes/bdd.php");
    //Supprime l'article renvoyé de l'historique d'achat
    $req = $db->prepare('DELETE FROM HISTORIQUE_ACHAT
                          WHERE id_utilisateur = :id_utilisateur
                          AND id_produit = :id_produit
                          AND id_historique = :id_historique');
    $req->execute([
      "id_utilisateur" => $UserId,
      "id_produit" => $id_produit,
      "id_historique" => $id_historique
    ]);
  }


  public static function refund($UserId, $prix_total){
    include("../../includes/bdd.php");
    //Rembourse l'utilisateur sur son solde euro
    $req = $db->prepare('UPDATE UTILISATEUR
                          SET solde_euro = solde_euro + :prix_total
                          WHERE id_utilisateur = :id_utilisateur');
           $req->execute([
             "prix_total" => $prix_total,
             "id_utilisateur" => $UserId
           ]);
  }

  public static function cancelFidelityPoints($UserId, $prix_total){
    include("../../includes/bdd.php");
    //Récupère les points de fidélités de l'utilisateur
    $req = $db->prepare('UPDATE UTILISATEUR
                          SET pts_fidelite = pts_fidelite - :prix_total
                          WHERE id_utilisateur = :id_utilisateur');
           $req->execute([
             "prix_total" => $prix_total * 10,
             "id_utilisateur" => $UserId
           ]);
  }



  public static function ReturnProduct($UserId, $id_produit, $id_historique){

    $prix_total = ReturnModel::GetPrice($UserId, $id_produit, $id_historique);
    ReturnModel::cancelFidelityPoints($UserId, $prix_total);
    ReturnModel::refund($UserId, $prix_total);
    ReturnModel::UpdateHistory($UserId, $id_produit, $id_historique);


  }
}


 ?>
