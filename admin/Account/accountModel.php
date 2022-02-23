<?php

class AccountModel{
  public static function SelectAccount(){
      include("../../includes/bdd.php");

      $query = $db->query("SELECT * FROM Utilisateur");

      return $query;
  }
  public static function DeleteAccount($id){
      include("../../includes/bdd.php");

      $query = $db->prepare("DELETE FROM historique_achat WHERE id_historique = (SELECT id_historique FROM utilisateur WHERE id_utilisateur = :id)");
      $query = $query->execute([
                  "id" => $id
                ]);

      echo $query;
      die;

      $query = $db->prepare("DELETE FROM utilisateur WHERE id_utilisateur = :id;");
      $query->execute([
        "id" => $id
      ]);
  }
}
 ?>
