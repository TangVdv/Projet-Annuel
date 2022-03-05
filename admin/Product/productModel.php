<?php
class productModel{
  public static function AddProduct($ProductToAdd){
    include("../../includes/bdd.php");

    $query = $db->prepare( "INSERT INTO Produit(image, nom, description, prix, reduction, stock) VALUES(:image, :name, :description, :price, :reduction, :stock);" );
    $res = $query->execute([
        "image" => $ProductToAdd["image"],
        "name" => $ProductToAdd["name"],
        "description" => $ProductToAdd["description"],
        "price" => $ProductToAdd["price"],
        "reduction" => 0,
        "stock" => $ProductToAdd["stock"]
    ]);

    $query = $db->prepare( "INSERT INTO dispose(id_entreprise, id_produit) VALUES(:id_entreprise, (SELECT id_produit FROM produit WHERE nom = :name));" );
    $query->execute([
        "id_entreprise" => $ProductToAdd["id_entreprise"],
        "name" => $ProductToAdd["name"]
    ]);


  }

  public static function SelectProduct(){
    include("../../includes/bdd.php");

    $query = $db->query("SELECT * FROM Produit");

    return $query;
  }

  public static function SelectSpecificProduct($id){
    include("../../includes/bdd.php");

    $query = $db->prepare("SELECT * FROM produit WHERE id_produit = :id");
    $query->execute([
      "id" => $id
    ]);

    return $query;
  }

  public static function DeleteProduct(){
    include("../../includes/bdd.php");

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

    header("location:index.php");
  }
}

?>
