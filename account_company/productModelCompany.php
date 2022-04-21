<?php
//include("../includes/checkAdmin.php");
class productModelCompany{
  public static function AddProduct($ProductToAdd){
    include("../includes/bdd.php");

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

    header('location:./products.php');
  }

  public static function SelectProduct($value){
    include("../includes/bdd.php");

    if($value){
      //$query = $db->query("SELECT id_produit, image, nom, description, prix, stock, reduction FROM Produit WHERE EXISTS (SELECT id_produit FROM Stock WHERE Stock.id_produit = Produit.id_produit) AND type='product'");

      $req = $db->prepare("SELECT produit.id_produit, image, nom, description, prix, stock, reduction
                            FROM PRODUIT
                            INNER JOIN DISPOSE ON produit.id_produit = dispose.id_produit
                            WHERE dispose.id_entreprise = :id_entreprise
                            AND EXISTS (SELECT id_produit
                                        FROM Stock
                                        WHERE Stock.id_produit = Produit.id_produit)
                            AND produit.type = :type");

    }
    else {
      //$query = $db->query("SELECT id_produit, image, nom, description, prix, stock, reduction FROM Produit WHERE NOT EXISTS (SELECT id_produit FROM Stock WHERE Stock.id_produit = Produit.id_produit) AND type='product'");
      $req = $db->prepare("SELECT produit.id_produit, image, nom, description, prix, stock, reduction
                            FROM PRODUIT
                            INNER JOIN DISPOSE ON produit.id_produit = dispose.id_produit
                            WHERE dispose.id_entreprise = :id_entreprise
                            AND NOT EXISTS (SELECT id_produit
                                        FROM Stock
                                        WHERE Stock.id_produit = Produit.id_produit)
                            AND type = :type");

    }

    $req->execute([
      "id_entreprise" => $_SESSION['id_entreprise'],
      "type" => "product"
    ]);

    return $req;
  }

  public static function SelectService(){
    include("../includes/bdd.php");

    /*
    $query = $db->query("SELECT id_produit, image, nom, description, prix, stock, reduction
                          FROM PRODUIT
                          INNER JOIN DISPOSE ON produit.id_produit = dispose.id_produit
                          WHERE type='service'");*/

    $req = $db->prepare("SELECT produit.id_produit, image, nom, description, prix, stock, reduction
                          FROM PRODUIT
                          INNER JOIN DISPOSE ON produit.id_produit = dispose.id_produit
                          WHERE type = :type
                          AND dispose.id_entreprise = :id_entreprise");
    $req->execute([
      "type" => "service",
      "id_entreprise" => $_SESSION['id_entreprise']
    ]);

    return $req;
  }

  public static function SelectSpecificProduct($id){
    include("../includes/bdd.php");

    $query = $db->prepare("SELECT id_produit, image, nom, description, prix, stock, reduction FROM produit WHERE id_produit = :id");
    $query->execute([
      "id" => $id
    ]);

    return $query;
  }

  public static function DeleteProduct(){
    include("../includes/bdd.php");

    if (!isset($_GET["id"]) || empty($_GET["id"])){
      header("location:./?message=Aucun id trouvé");
      die;
    }

    $id = $_GET['id'];

    $res = productModelCompany::SelectSpecificProduct($id);
    $row = $res->fetch(PDO::FETCH_OBJ);
    $path = "../img/products/".$row->image;
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

    header("location:./products.php");
  }


  public static function checkPaymentStatus(){
    include("../includes/bdd.php");

    $req = $db->prepare("SELECT statut_cotisation
                          FROM ENTREPRISE
                          WHERE id_entreprise = :id_entreprise");
    $req->execute([
      "id_entreprise" => $_SESSION['id_entreprise']
    ]);

    return $req;
  }

  public static function getChiffreAffaire(){
    include("../includes/bdd.php");

    $req = $db->prepare("SELECT chiffre_affaire
                          FROM ENTREPRISE
                          WHERE id_entreprise = :id_entreprise");
    $req->execute([
      "id_entreprise" => $_SESSION['id_entreprise']
    ]);

    return $req;
  }

  public static function updateChiffreAffaire($CA){
    include("../includes/bdd.php");

    $req = $db->prepare("UPDATE ENTREPRISE
                          SET chiffre_affaire = :chiffre_affaire
                          WHERE id_entreprise = :id_entreprise");
    $req->execute([
      "chiffre_affaire" => $CA,
      "id_entreprise" => $_SESSION['id_entreprise']
    ]);
  }


}

?>
