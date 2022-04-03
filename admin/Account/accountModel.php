<?php

class accountModel{
  public static function SelectAccount(){
      include("../../includes/bdd.php");

      $query = $db->query("SELECT * FROM Utilisateur");

      return $query;
  }

  public static function DeleteAccount($id){
      include("../../includes/bdd.php");

      $query = $db->prepare("DELETE FROM ajoute WHERE id_panier = (SELECT id_panier FROM panier WHERE id_utilisateur = :id)");
      $query->execute([
        "id" => $id
      ]);

      $query = $db->prepare("DELETE FROM achete WHERE id_utilisateur = :id");
      $query->execute([
        "id" => $id
      ]);

      $query = $db->prepare("DELETE FROM panier WHERE id_utilisateur = :id");
      $query->execute([
        "id" => $id
      ]);

      $query = $db->prepare("DELETE FROM utilisateur WHERE id_utilisateur = :id");
      $query->execute([
        "id" => $id
      ]);
  }
}
 ?>
