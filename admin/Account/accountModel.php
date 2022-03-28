<?php
include("../includes/checkAdmin.php");
class accountModel{
  public static function SelectAccount(){
      include("../../includes/bdd.php");

      $query = $db->query("SELECT id_utilisateur, nom, prenom, email FROM Utilisateur");

      return $query;
  }
  public static function DeleteAccount(){
      include("../../includes/bdd.php");

      if (!isset($_GET["id"]) || empty($_GET["id"])){
        header("location:./?message=Aucun id trouvé");
        die;
      }

      $id = $_GET["id"];

      $query = $db->prepare("DELETE FROM achete WHERE id_utilisateur = :id");
      $query->execute([
        "id" => $id
      ]);
      
      $query = $db->prepare("DELETE FROM utilisateur WHERE id_utilisateur = :id");
      $query->execute([
        "id" => $id
      ]);

      header("location:./");
  }
}
 ?>
