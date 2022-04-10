<?php
include("../includes/checkAdmin.php");
class productModel{
  public static function AddProduct($ProductToAdd){
    include("../../includes/bdd.php");

    $query = $db->prepare( "INSERT INTO Produit(image, nom, description, prix, reduction, stock, type) VALUES(:image, :name, :description, :price, :reduction, :stock, :type);" );
    $res = $query->execute([
        "image" => $ProductToAdd["image"],
        "name" => $_POST["name"],
        "description" => $_POST["description"],
        "price" => $_POST["price"],
        "reduction" => 0,
        "stock" => $_POST["stock"],
        "type" => $ProductToAdd["type_value"]
    ]);

    $query = $db->prepare( "INSERT INTO dispose(id_entreprise, id_produit) VALUES(:id_entreprise, (SELECT id_produit FROM produit WHERE nom = :name));" );
    $query->execute([
        "id_entreprise" => $ProductToAdd["id_entreprise"],
        "name" => $_POST["name"]
    ]);

    header('location:./');
  }

  public static function SelectProduct($value){
    include("../../includes/bdd.php");

    if($value){
      $query = $db->query("SELECT id_produit, image, nom, description, prix, stock, reduction FROM Produit WHERE EXISTS (SELECT id_produit FROM Stock WHERE Stock.id_produit = Produit.id_produit) AND type='product'");
    }
    else {
      $query = $db->query("SELECT id_produit, image, nom, description, prix, stock, reduction FROM Produit WHERE NOT EXISTS (SELECT id_produit FROM Stock WHERE Stock.id_produit = Produit.id_produit) AND type='product'");
    }

    return $query;
  }

  public static function SelectService(){
    include("../../includes/bdd.php");

    $query = $db->query("SELECT id_produit, image, nom, description, prix, stock, reduction FROM Produit WHERE type='service'");

    return $query;
  }

  public static function SelectSpecificProduct($id){
    include("../../includes/bdd.php");

    $query = $db->prepare("SELECT id_produit, image, nom, description, prix, stock, reduction FROM produit WHERE id_produit = :id");
    $query->execute([
      "id" => $id
    ]);

    return $query;
  }

  public static function DeleteProduct(){
    include("../../includes/bdd.php");

    if (!isset($_GET["id"]) || empty($_GET["id"])){
      header("location:./?message=Aucun id trouvé");
      die;
    }

    $id = $_GET['id'];

    $res = productModel::SelectSpecificProduct($id);
    $row = $res->fetch(PDO::FETCH_OBJ);
    $path = "../../img/products/".$row->image;
    unlink($path);

    $query = $db->prepare("DELETE FROM stock WHERE id_produit = :id");
    $query->execute([
      "id" => $id
    ]);

    $query = $db->prepare("DELETE FROM dispose WHERE id_produit = :id");
    $query->execute([
      "id" => $id
    ]);

    $query = $db->prepare("DELETE FROM produit WHERE id_produit = :id");
    $query->execute([
      "id" => $id
    ]);

    header("location:./");
  }
}

?>
