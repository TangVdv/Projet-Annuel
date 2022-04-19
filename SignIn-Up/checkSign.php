<?php
include('signModel.php');

// SIGN IN
if(isset($_POST["sign_in"])) {
  $password = $_POST['mot_de_passe'];
  $email = $_POST['email'];

  // Rejète si le mdp est inférieur a 6
  if (strlen($password) < 6) {
    header('location:sign_in.php?message=Le mot de passe doit contenir au minimum 6 charactère&type=danger');
    exit;
  }

  // Rejète si email ou mdp vide, pas besoin techniquement
  if ( !isset($email) || empty($email) || ()) ){
    header('location:sign_in.php?message=Vous devez remplir les 2 champs.&type=danger');
    exit;
  }

  SignModel::IfUserExist();
}


// SIGN UP
if(isset($_POST["sign_up"])) {
  // Mdp < 6
  if ( strlen(trim($_POST['mot_de_passe'])) < 6 || strlen(trim($_POST['prenom'])) < 1 ) {
    header('location:sign_up.php?message=Le mot de passe doit contenir au minimum 6 charactère&type=danger');
  }

  SignModel::AddAccount();
}

?>
