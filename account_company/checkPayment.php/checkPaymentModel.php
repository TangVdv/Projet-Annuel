<?php

class checkPaymentModel{

  public static function selectDatesToUpdate(){
    include("../../includes/bdd.php");

    $req = $db->prepare("SELECT id_entreprise, statut_cotisation
                          FROM ENTREPRISE
                          WHERE date_paiement = :currentDate");
    $req->execute([
      "currentDate" => date('Y-m-d')
    ]);

    return $req;
  }

  public static function updatePaidStatus($id,  $status){
    include("../../includes/bdd.php");

    $newStatus = 2;
    if($status == 0){
      $newStatus = 2;
    }elseif ($status == 1) {
      $newStatus = 0;
    }

    $query = $db->prepare("UPDATE entreprise SET statut_cotisation = :value WHERE id_entreprise = :id");
    $query->execute([
      "value" => $newStatus,
      "id" => $id
    ]);
  }

}



 ?>
