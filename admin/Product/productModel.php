<?php
class ProductModel{
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
}


 ?>
