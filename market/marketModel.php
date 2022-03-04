<?php

class addToCartModel{
  public static function InsertProduct($ProductToAdd){
    include("../includes/bdd.php");

    $ProductId = $ProductToAdd["id_produit"];
    $CartId = $ProductToAdd["id_panier"];

    $query = $db->prepare( "INSERT INTO ajoute(id_produit, id_panier) VALUES(:ProductId, :CartId);" );
    $query->execute([
        "ProductId" => $ProductId,
        "CartId" => $CartId
    ]);
  }

  public static function SelectProduct(){
    include("../includes/bdd.php");

    $query = $db->query("SELECT * FROM Produit");

    return $query;
  }
}
?>
