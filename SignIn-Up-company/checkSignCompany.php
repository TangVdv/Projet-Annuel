<?php




// SIGN UP
if(isset($_POST["sign_up"])) {
  // Mdp < 6
  if ( strlen(trim($_POST['mot_de_passe'])) < 6 || strlen(trim($_POST['nom'])) < 1 ) {
    header('location:sign_up.php?message=Le mot de passe doit contenir au minimum 6 charactère&type=danger');
  }

  SignModel::AddAccount();
}


 ?>
