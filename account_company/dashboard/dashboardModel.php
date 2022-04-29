<?php

class dashboardModel{

/*
Informations à récupérer:
X-Nombre de commandes/vente unique sur le site
X-Nombre de clients unique
X-% de vente de l'entreprise sur l'ensemble du site
X-Nombre de produit/prestation en vente
X-Nombre de stock total
X-Jour avant la prochaine date de paiement


*/

  public static function getNumberOfUniqueSales(){
    include("../includes/bdd.php");


    $req = $db->prepare("SELECT COUNT(*) as total
                          FROM HISTORIQUE_ACHAT
                          INNER JOIN DISPOSE ON dispose.id_produit = historique_achat.id_produit
                          WHERE dispose.id_entreprise = :id_entreprise");



    $req->execute([
      "id_entreprise" => $_SESSION['id_entreprise']
    ]);
    $result = 0;
    while ($row = $req->fetch(PDO::FETCH_OBJ)){
      $result = $row->total;
    }

    return $result;
  }


  public static function getNumberOfUniqueCustomers(){
    include("../includes/bdd.php");


    $req = $db->prepare("SELECT COUNT(DISTINCT id_utilisateur) as total
                          FROM HISTORIQUE_ACHAT
                          INNER JOIN DISPOSE ON dispose.id_produit = historique_achat.id_produit
                          WHERE dispose.id_entreprise = :id_entreprise");



    $req->execute([
      "id_entreprise" => $_SESSION['id_entreprise']
    ]);
    $result = 0;
    while ($row = $req->fetch(PDO::FETCH_OBJ)){
      $result = $row->total;
    }

    return $result;
  }


  public static function getPourcentageFromTotalSales(){
    include("../includes/bdd.php");

    $req = $db->prepare("SELECT COUNT(*) as total
                          FROM HISTORIQUE_ACHAT");



    $req->execute([
      //"id_entreprise" => $_SESSION['id_entreprise']
    ]);

    $unique_sales = dashboardModel::getNumberOfUniqueSales();

    $result = 0;
    while ($row = $req->fetch(PDO::FETCH_OBJ)){
      if ($row->total == 0) {
        return 0;
      }
      $result = ($unique_sales / $row->total) * 100;
    }

    return $result;
  }


  public static function getNumberOfProductsAvailable(){
    include("../includes/bdd.php");
    //Select number of products from the company
    $req = $db->prepare("SELECT COUNT(*) as total
                          FROM DISPOSE
                          WHERE id_entreprise = :id_entreprise");


    $req->execute([
      "id_entreprise" => $_SESSION['id_entreprise']
    ]);

    $result = 0;
    while ($row = $req->fetch(PDO::FETCH_OBJ)){
      $result = $row->total;
    }

    return $result;
  }


  public static function getNumberOfTotalStock(){
    include("../includes/bdd.php");


    $req = $db->prepare("SELECT stock
                          FROM PRODUIT
                          INNER JOIN DISPOSE ON dispose.id_produit = produit.id_produit
                          WHERE id_entreprise = :id_entreprise");



    $req->execute([
      "id_entreprise" => $_SESSION['id_entreprise']
    ]);

    $result = 0;
    while ($row = $req->fetch(PDO::FETCH_OBJ)){
      $result += $row->stock;
    }

    return $result;
  }



  public static function getDaysBeforeNextPayment(){
    include("../includes/bdd.php");
    require_once("productModelCompany.php");

    $req = productModelCompany::checkPaymentStatus();
    $result = 0;
    while ($row = $req->fetch(PDO::FETCH_OBJ)){
      $result = $row->statut_cotisation;
    }

    if($result == 2){
      return 0;
    }else {
      $req = $db->prepare("SELECT date_paiement
                            FROM ENTREPRISE
                            WHERE id_entreprise = :id_entreprise");



      $req->execute([
        "id_entreprise" => $_SESSION['id_entreprise']
      ]);
      $result = "";
      while ($row = $req->fetch(PDO::FETCH_OBJ)){
        $result = $row->date_paiement;
      }

      $payment_date = date_create($result);
      $today = date_create(date('Y-m-d'));
      $interval = date_diff($payment_date, $today);

      return $interval->format('%a');
    }
  }


}



 ?>
