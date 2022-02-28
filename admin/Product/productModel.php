<?php
class productModel{
  public static function AddProduct($ProductToAdd){
    include("../../includes/bdd.php");

    $query = $db->prepare( "INSERT INTO Produit(image, nom, prix, stock) VALUES(:image, :name, :price, :stock);" );
    $query->execute([
        "image" => $ProductToAdd["image"],
        "name" => $ProductToAdd["name"],
        "price" => $ProductToAdd["price"],
        "stock" => $ProductToAdd["stock"]
    ]);
  }

  public static function SelectProduct(){
    include("../../includes/bdd.php");

    $query = $db->query("SELECT * FROM Produit");

    return $query;
  }

  public static function DeleteProduct(){
    include("../../includes/bdd.php");

    $id = $_GET['id'];

    $query = $db->prepare("DELETE FROM dispose WHERE id_produit = :id)");
    $query->execute([
      "id" => $id
    ]);

    $query = $db->prepare("DELETE FROM produit WHERE id_produit = :id");
    $query->execute([
      "id" => $id
    ]);
  }
}


 ?>
