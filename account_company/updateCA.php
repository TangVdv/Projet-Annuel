<?php
  session_start();
  if(isset($_POST['CA'])){
    include("productModelCompany.php");
    productModelCompany::updateChiffreAffaire($_POST['CA']);
    header("location:account.php");
  }else {
    header("location:account.php?message=Erreur");
  }

 ?>
