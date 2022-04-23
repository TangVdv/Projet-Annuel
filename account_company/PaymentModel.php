<?php

class PaymentModel{

  public static function updatePaymentStatus(){
    include("productModelCompany.php");

    $req = productModelCompany::checkPaymentStatus();
    while ($row = $req->fetch(PDO::FETCH_OBJ)){
      $status = $row->statut_cotisation;
      if($status == 0 || $status == 2){
        PaymentModel::UpdateContributionStatus(1);
        PaymentModel::UpdateContributionDate();
        header("location:account.php");

      }else{
        header("location:account.php?message=Erreur");
      }

    }

  }


  public static function UpdateContributionStatus($newStatus){
    include("../includes/bdd.php");


    $id = $_SESSION['id_entreprise'];

    $query = $db->prepare("UPDATE entreprise SET statut_cotisation = :value WHERE id_entreprise = :id");
    $query->execute([
      "value" => $newStatus,
      "id" => $id
    ]);

    //die;
  }

  public static function UpdateContributionDate(){
    include("../includes/bdd.php");

    $id = $_SESSION['id_entreprise'];

    $query = $db->prepare("UPDATE entreprise SET date_paiement = :value WHERE id_entreprise = :id");

    $dateInvolved = PaymentModel::getPaymentDate();
    //echo $dateInvolved;
    if($dateInvolved == "null"){
      $query->execute([
        "value" => date('Y-m-d', strtotime('+1 year')),
        "id" => $id
      ]);
    }else{
      $query->execute([
        "value" => date('Y-m-d', strtotime($dateInvolved . ' +1 year')),
        "id" => $id
      ]);
    }



  }

  public static function getPaymentDate(){
    include("../includes/bdd.php");

    $req = $db->prepare("SELECT date_paiement
                          FROM ENTREPRISE
                          WHERE id_entreprise = :id_entreprise");
    $req->execute([
      "id_entreprise" => $_SESSION['id_entreprise']
    ]);

    $dateInvolved = "";
    while ($row = $req->fetch(PDO::FETCH_OBJ)){
      $dateInvolved = $row->date_paiement;
    }

    return $dateInvolved;
  }


}

 ?>
