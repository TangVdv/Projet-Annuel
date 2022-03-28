<?php
include("../includes/checkAdmin.php");
class stockModel{
  public static function SelectStock(){
      include("../../includes/bdd.php");

      $query = $db->query("SELECT id_entrepot, adresse, nom, telephone FROM entrepot");

      return $query;
  }

  public static function SelectSpecificStock(){
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

  public static function SelectProductAsStock(){
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

  public static function AddProductToStock(){
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
    die;
  }

  public static function DeleteProductFromStock(){
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
    die;
  }

  public static function DeleteStock(){
    include("../../includes/bdd.php");

    if (!isset($_GET["id"]) || empty($_GET["id"])){
      header("location:./?message=Aucun id trouvé");
      die;
    }

    $id = $_GET["id"];

    $query = $db->prepare("DELETE FROM stock WHERE id_entrepot = :id");
    $query->execute([
      "id" => $id,
    ]);

    $query = $db->prepare("DELETE FROM entrepot WHERE id_entrepot = :id");
    $query->execute([
      "id" => $id,
    ]);
  }

  public static function AddStock(){
    include("../../includes/bdd.php");

    $query = $db->prepare("INSERT INTO entrepot(adresse, nom, telephone) VALUES(:addr, :name, :phone)");
    $query->execute([
      "addr" => $_POST["addr"],
      "name" => $_POST["name"],
      "phone" => $_POST["phone"]
    ]);
  }

  public static function IfStockAlreadyExist(){
    include("../../includes/bdd.php");

    $query = $db->prepare( "SELECT COUNT(*) as total FROM entrepot WHERE nom = :name OR adresse = :addr OR telephone = :phone");
    $query->execute([
      "addr" => $_POST["addr"],
      "name" => $_POST["name"],
      "phone" => $_POST["phone"]
    ]);
    $row = $query->fetch(PDO::FETCH_OBJ);
    if($row->total != 0){
      return true;
    }
    return false;
  }
}

 ?>
