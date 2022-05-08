<?php
include("../includes/checkAdmin.php");
class CompagnyModel{
  public static function SelectCompagny(){
    include("../../includes/bdd.php");

    $query = $db->query("SELECT id_entreprise, nom from entreprise");

    return $query;
  }

  public static function SelectSpecificCompagny(){
    include("../../includes/bdd.php");

    if (!isset($_GET["id"]) || empty($_GET["id"])){
      header("location:./?message=Aucun id trouvé");
      die;
    }

    $id = $_GET["id"];

    $query = $db->prepare("SELECT nom, chiffre_affaire, statut_cotisation from entreprise where id_entreprise = :id");
    $query->execute([
      "id" => $id
    ]);

    return $query;
  }

  public static function SelectProductAsCompagny(){
    include("../../includes/bdd.php");

    if (!isset($_GET["id"]) || empty($_GET["id"])){
      header("location:./?message=Aucun id trouvé");
      die;
    }

    $id = $_GET["id"];

    $query = $db->prepare("SELECT * from produit INNER JOIN dispose ON produit.id_produit = dispose.id_produit WHERE dispose.id_entreprise = :id");
    $query->execute([
      "id" => $id
    ]);

    return $query;
  }

  public static function IfCompagnyAlreadyExist($name){
    include("../../includes/bdd.php");

    $query = $db->prepare( "SELECT COUNT(*) as total FROM entreprise WHERE nom = :name" );
    $query->execute([
        "name" => $name,
    ]);
    $row = $query->fetch(PDO::FETCH_OBJ);
    if($row->total != 0){
      return true;
    }
    return false;
  }

  public static function DeleteCompagny(){
    include("../../includes/bdd.php");

    if (!isset($_GET["id"]) || empty($_GET["id"])){
      header("location:./?message=Aucun id trouvé");
      die;
    }

    $id = $_GET["id"];

    $query = $db->prepare("DELETE FROM dispose WHERE id_entreprise = :id");
    $query->execute([
      "id" => $id
    ]);

    $query = $db->prepare( "DELETE FROM Entreprise WHERE id_entreprise = :id" );
    $res = $query->execute([
        "id" => $id
    ]);
  }
}
 ?>
