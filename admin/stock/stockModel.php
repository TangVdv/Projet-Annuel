<?php
include("../includes/checkAdmin.php");
class stockModel{
  public static function SelectStock(){
      include("../../includes/bdd.php");

      $query = $db->query("SELECT id_entrepot, adresse, nom, telephone FROM entrepot");

      return $query;
  }

  public static function selectSpecificStock(){
    include("../../includes/bdd.php");

    if (!isset($_GET["id"]) || empty($_GET["id"])){
      header("location:./?message=Aucun id trouvé");
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
      header("location:./?message=Aucun id trouvé");
      die;
    }

    $id = $_GET["id"];

    $query = $db->prepare("SELECT produit.id_produit, image, nom, description, prix, stock, reduction from produit INNER JOIN stock ON produit.id_produit = stock.id_produit WHERE stock.id_entrepot = :id");
    $query->execute([
      "id" => $id
    ]);

    return $query;
  }

  public static function addProductToStock(){
    include("../../includes/bdd.php");

    if (!isset($_GET["idP"]) || empty($_GET["idP"])){
      header("location:./?message=L'id du produit n'a pas été trouvé");
      die;
    }
    if (!isset($_GET["idE"]) || empty($_GET["idE"])){
      header("location:./?message=L'id de l'entrepot n'a pas été trouvé");
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
      header("location:./?message=L'id du produit n'a pas été trouvé");
      die;
    }
    if (!isset($_GET["idE"]) || empty($_GET["idE"])){
      header("location:./?message=L'id de l'entrepot n'a pas été trouvé");
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
