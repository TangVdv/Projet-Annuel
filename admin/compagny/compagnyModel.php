<?php

if (!isset($_GET["id"]) || empty($_GET["id"])){
  echo "None id found";
  die;
}

class CompagnyModel{
  public static function selectCompagny(){
    include("../../includes/bdd.php");

    $query = $db->query("SELECT id_entreprise, nom from entreprise");

    return $query;
  }


  public static function selectSpecificCompagny(){
    include("../../includes/bdd.php");

    $id = $_GET["id"];

    $query = $db->prepare("SELECT nom from entreprise where id_entreprise = :id");
    $query->execute([
      "id" => $id
    ]);

    return $query;
  }

  public static function selectProductAsCompagny(){
    include("../../includes/bdd.php");

    $id = $_GET["id"];

    $query = $db->prepare("SELECT * from produit INNER JOIN dispose ON produit.id_produit = dispose.id_produit WHERE dispose.id_entreprise = :id");
    $query->execute([
      "id" => $id
    ]);

    return $query;
  }
}
 ?>
