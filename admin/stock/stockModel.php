<?php

class stockModel{
  public static function SelectStock(){
      include("../../includes/bdd.php");

      $query = $db->query("SELECT * FROM entrepot");

      return $query;
  }

  public static function selectSpecificCompagny(){
    include("../../includes/bdd.php");

    if (!isset($_GET["id"]) || empty($_GET["id"])){
      echo "None id found";
      die;
    }

    $id = $_GET["id"];

    $query = $db->prepare("SELECT nom from entrepot where id_entrepot = :id");
    $query->execute([
      "id" => $id
    ]);

    return $query;
  }

  public static function selectProductAsStock(){
    include("../../includes/bdd.php");

    if (!isset($_GET["id"]) || empty($_GET["id"])){
      echo "None id found";
      die;
    }

    $id = $_GET["id"];

    $query = $db->prepare("SELECT * from produit INNER JOIN stock ON produit.id_produit = stock.id_produit WHERE stock.id_entrepot = :id");
    $query->execute([
      "id" => $id
    ]);

    return $query;
  }

  public static function addProductToStock(){
    include("../../includes/bdd.php");

    if (!isset($_GET["idP"]) || empty($_GET["idP"])){
      echo "None id found";
      die;
    }

    $idP = $_GET["idP"];
    $idE = $_GET["idE"];

    $query = $db->prepare("INSERT INTO stock(id_produit, id_entrepot) VALUES(:id_produit, :id_entrepot)");
    $query->execute([
      "id_produit" => $idP,
      "id_entrepot" => $idE
    ]);

    header("location:stockShow.php?id=".$idE);
  }

  public static function deleteProductFromStock(){
    include("../../includes/bdd.php");

    if (!isset($_GET["idP"]) || empty($_GET["idP"])){
      echo "None id found";
      die;
    }

    $idP = $_GET["idP"];
    $idE = $_GET["idE"];

    $query = $db->prepare("DELETE FROM stock WHERE id_produit = :id_produit AND id_entrepot = :id_entrepot");
    $query->execute([
      "id_produit" => $idP,
      "id_entrepot" => $idE
    ]);

    header("location:stockShow.php?id=".$idE);
  }
}

 ?>
