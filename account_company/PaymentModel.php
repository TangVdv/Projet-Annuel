<?php

class PaymentModel{

  public static function updatePaymentStatus(){
    include("productModelCompany.php");

    $req = productModelCompany::checkPaymentStatus();
    while ($row = $req->fetch(PDO::FETCH_OBJ)){
      $status = $row->statut_cotisation;
      if($status == 0){
        PaymentModel::UpdateContributionStatus(1);
        header("location:account.php");

      }elseif ($status == 2) {
        PaymentModel::UpdateContributionStatus(0);
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

    die;
  }


}

 ?>
