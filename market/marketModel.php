<?php

class MarketModel{
  // PRODUCT
  public static function SelectSpecificProduct(){
    include("../includes/bdd.php");
    $query = $db->prepare("SELECT COUNT(*) as total FROM achete WHERE id_produit = :ProductId AND id_utilisateur = :UserId");
    $query->execute([
        "ProductId" => $_GET["id_produit"],
        "UserId" => $_SESSION["id_utilisateur"]
    ]);

    $res = $query->fetch(PDO::FETCH_OBJ);
    $rowCount = $res->total;
    return $rowCount;
  }

  public static function UpdateProduct(){
    include("../includes/bdd.php");

    $query = $db->prepare('UPDATE ACHETE SET quantite = quantite + 1 WHERE id_utilisateur = :id_utilisateur AND id_produit = :id_produit');
    $query->execute([
      "id_utilisateur" => $_SESSION["id_utilisateur"],
      "id_produit" => htmlspecialchars($_GET["id_produit"])
    ]);
  }

  public static function InsertProduct(){
    include("../includes/bdd.php");

    $query = $db->prepare("INSERT INTO achete(id_produit, id_utilisateur, quantite) VALUES (:ProductId, :UserId, 1)");
    $query->execute([
        "ProductId" => $_GET["id_produit"],
        "UserId" => $_SESSION["id_utilisateur"]
    ]);
  }

  public static function SelectProduct(){
    include("../includes/bdd.php");

    $query = $db->query("SELECT id_produit, nom, image, description, prix, stock, reduction FROM Produit WHERE EXISTS (SELECT id_produit FROM Stock WHERE Stock.id_produit = Produit.id_produit)");

    return $query;
  }

  // SERVICE
  /*
  public static function SelectSpecificService(){
    include("../includes/bdd.php");
    $query = $db->prepare("SELECT COUNT(*) as total FROM achete WHERE id_prestation = :ServiceId AND id_utilisateur = :UserId");
    $query->execute([
        "ServiceId" => $_GET["id_prestation"],
        "UserId" => $_SESSION["id_utilisateur"]
    ]);

    $res = $query->fetch(PDO::FETCH_OBJ);
    $rowCount = $res->total;
    return $rowCount;
  }

  public static function UpdateService(){
    include("../includes/bdd.php");

    $query = $db->prepare('UPDATE ACHETE SET quantite = quantite + 1 WHERE id_utilisateur = :id_utilisateur AND id_prestation = :id_prestation');
    $query->execute([
      "id_utilisateur" => $_SESSION["id_utilisateur"],
      "id_prestation" => htmlspecialchars($_GET["id_prestation"])
    ]);
  }

  public static function InsertProduct(){
    include("../includes/bdd.php");

    $query = $db->prepare("INSERT INTO achete(id_prestation, id_utilisateur, quantite) VALUES (:ServiceId, :UserId, 1)");
    $query->execute([
        "ServiceId" => $_GET["id_prestation"],
        "UserId" => $_SESSION["id_utilisateur"]
    ]);
  }
*/

  public static function SelectService(){
    include("../includes/bdd.php");

    $query = $db->query("SELECT id_prestation, nom, image, description, prix, stock, reduction FROM prestation");

    return $query;
  }
}
