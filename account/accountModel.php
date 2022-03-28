<?php

class AccountModel {

  public static function DisplayLastOrder() {
    include("../includes/bdd.php");

    $req = $db->query("SELECT * FROM historique_achat DESC LIMIT 1");

    return $req;
  }

  public static function DisplayOrders() {
    include("../includes/bdd.php");

    $req = $db->query("SELECT * FROM historique_achat");

    return $req;
  }

}



?>
