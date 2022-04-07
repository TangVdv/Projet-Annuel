<?php
include("../includes/checkAdmin.php");
class ServiceModel{
  public static function AddService($ServiceToAdd){
    include("../../includes/bdd.php");

    $query = $db->prepare( "INSERT INTO prestation(image, nom, description, prix, reduction, stock, id_entreprise) VALUES(:image, :name, :description, :price, :reduction, :stock, :id_entreprise);" );
    $res = $query->execute([
        "image" => $ServiceToAdd["image"],
        "name" => $_POST["name"],
        "description" => $_POST["description"],
        "price" => $_POST["price"],
        "reduction" => 0,
        "stock" => $_POST["stock"],
        "id_entreprise" => $ServiceToAdd["id_entreprise"]
    ]);

  }

  public static function SelectService(){
    include("../../includes/bdd.php");

    $query = $db->query("SELECT id_prestation, image, nom, description, prix, date_mise_en_ligne, reduction, stock, id_entreprise FROM prestation");

    return $query;
  }

  public static function SelectSpecificService($id){
    include("../../includes/bdd.php");

    $query = $db->prepare("SELECT id_prestation, image, nom, description, prix, date_mise_en_ligne, reduction, stock, id_entreprise FROM prestation WHERE id_prestation = :id");
    $query->execute([
      "id" => $id
    ]);

    return $query;
  }

  public static function DeleteService(){
    include("../../includes/bdd.php");

    if (!isset($_GET["id"]) || empty($_GET["id"])){
      header("location:./?message=Aucun id trouvé");
      die;
    }

    $id = $_GET['id'];

    $res = ServiceModel::SelectSpecificService($id);
    $row = $res->fetch(PDO::FETCH_OBJ);
    $path = "../../img/products/".$row->image;
    unlink($path);

    $query = $db->prepare("DELETE FROM prestation WHERE id_prestation = :id");
    $query->execute([
      "id" => $id
    ]);
  }
}

?>
