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

    $query = $db->prepare("SELECT nom, cotisation, statut_cotisation from entreprise where id_entreprise = :id");
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

  public static function CalculContribution($turnover){
    if($turnover > 200000) $contribution = 0;
    if($turnover < 800000) $contribution = 0.8;
    if($turnover < 1500000) $contribution = 0.6;
    if($turnover < 3000000) $contribution = 0.4;
    else $contribution = 0.3;

    $contribution = $contribution * $turnover / 100;

    return $contribution;
  }

  public static function AddCompagny(){
    include("../../includes/bdd.php");

    $turnover = $_POST["turnover"];

    $contribution = CompagnyModel::CalculContribution($turnover);

    $query = $db->prepare( "INSERT INTO Entreprise(nom, cotisation, statut_cotisation) VALUES(:name, :contribution, :contribution_status);" );
    $res = $query->execute([
        "name" => $_POST["name"],
        "contribution" => $contribution,
        "contribution_status" => 0,
    ]);
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

  public static function UpdateContributionStatus(){
    include("../../includes/bdd.php");

    if (!isset($_GET["id"]) || empty($_GET["id"])){
      header("location:./?message=Aucun id trouvé");
      die;
    }

    $id = $_GET["id"];

    $query = $db->prepare("UPDATE entreprise SET statut_cotisation = :value WHERE id_entreprise = :id");
    $query->execute([
      "value" => $_POST["status"],
      "id" => $id
    ]);

    header("location:compagnyShow.php?id=".$_GET["id"]);
    die;
  }

  public static function UpdateContribution(){
    include("../../includes/bdd.php");

    if (!isset($_GET["id"]) || empty($_GET["id"])){
      header("location:./?message=Aucun id trouvé");
      die;
    }

    $id = $_GET["id"];

    $contribution = CompagnyModel::CalculContribution($_POST["turnover"]);

    $query = $db->prepare("UPDATE entreprise SET cotisation = :value WHERE id_entreprise = :id");
    $query->execute([
      "value" => $contribution,
      "id" => $id
    ]);

    header("location:compagnyShow.php?id=".$_GET["id"]);
    die;
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
