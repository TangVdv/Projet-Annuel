<?php

class compagnyModel{
  public static function SelectCompagny(){
    include("../../includes/bdd.php");

    $query = $db->query("SELECT id_entreprise, nom from entreprise");

    return $query;
  }

  public static function SelectSpecificCompagny(){
    include("../../includes/bdd.php");

    if (!isset($_GET["id"]) || empty($_GET["id"])){
      echo "None id found";
      die;
    }

    $id = $_GET["id"];

    $query = $db->prepare("SELECT nom from entreprise where id_entreprise = :id");
    $query->execute([
      "id" => $id
    ]);

    return $query;
  }

  public static function SelectProductAsCompagny(){
    include("../../includes/bdd.php");

    $id = $_GET["id"];

    $query = $db->prepare("SELECT * from produit INNER JOIN dispose ON produit.id_produit = dispose.id_produit WHERE dispose.id_entreprise = :id");
    $query->execute([
      "id" => $id
    ]);

    return $query;
  }

  public static function AddCompagny($CompagnyToAdd){
    include("../../includes/bdd.php");

    $turnover = $CompagnyToAdd["turnover"];


    $query = $db->prepare( "INSERT INTO Entreprise(nom, cotisation, statut_cotisation) VALUES(:name, :contribution, :contribution_status);" );
    $res = $query->execute([
        "name" => $CompagnyToAdd["name"],
        "contribution" => $contribution,
        "contribution_status" => 0,
    ]);
  }
}
 ?>
