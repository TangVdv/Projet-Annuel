<?php

  //Select toutes les entreprises dont la date de paiment est aujourd'hui
  /*Vérifier leur statut puis modifier:
  -->0 => 2
  -->1 => 0
  0 -> En attente de paiment (accès autorisé)
  1 -> Paiment effectué (accès autorisé)
  2 -> Paiment non effectué (accès refusé)
  */
  include("checkPaymentModel");

  $req = checkPaymentModel::selectDatesToUpdate();
  while ($row = $req->fetch(PDO::FETCH_OBJ)){
    checkPaymentModel::selectDatesToUpdate($row->id_entreprise, $row->statut_cotisation);
  }

 ?>
