<?php

class addToCartModel{
  public static function InsertProduct($ProductId){
    include("../includes/bdd.php");
    session_start();

    $UserId = $_SESSION["id_utilisateur"];

    $query = $db->prepare("INSERT INTO achete(id_produit, id_utilisateur, quantite) VALUES (:ProductId, :UserId, 1) ON DUPLICATE KEY UPDATE quantite = quantite + 1");
    $query->execute([
        "ProductId" => $ProductId,
        "UserId" => $UserId
    ]);
  }

  public static function SelectProduct(){
    include("../includes/bdd.php");

    $query = $db->query("SELECT id_produit, nom, image, description, prix, stock, reduction FROM Produit WHERE EXISTS (SELECT id_produit FROM Stock WHERE Stock.id_produit = Produit.id_produit)");


    return $query;
  }
}
?>
