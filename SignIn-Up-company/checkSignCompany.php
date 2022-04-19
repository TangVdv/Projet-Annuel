<?php

include('SignModelCompany.php');

// SIGN IN
if(isset($_POST["sign_in_company"])) {
  $password = $_POST['mot_de_passe'];
  $nom = $_POST['nom'];

  // Rejète si le mdp est inférieur a 6
  if (strlen($password) < 6) {
    header('location:sign_in_company.php?message=Le mot de passe doit contenir au minimum 6 charactère&type=danger');
    exit;
  }

  // Rejète si nom ou mdp vide, pas besoin techniquement
  if ( !isset($nom) || empty($nom) || (!isset($password) || empty($password)) ){
    header('location:sign_in_company.php?message=Vous devez remplir les 2 champs.&type=danger');
    exit;
  }

  SignModelCompany::IfCompanyExist();
}


// SIGN UP
if(isset($_POST["sign_up_company"])) {
  // Mdp < 6
  if ( strlen(trim($_POST['mot_de_passe'])) < 6 || strlen($_POST['nom']) < 1 ) {
    header('location:sign_up_company.php?message=Le mot de passe doit contenir au minimum 6 charactère&type=danger');
  }

  SignModelCompany::AddAccount();
}


 ?>
