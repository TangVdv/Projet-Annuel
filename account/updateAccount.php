<?php

if (isset($_POST["submit-button"])) {
  include("../SignIn-Up/signModel.php");
  include("AccountPageModel.php");

  session_start();

  $nom =	$_POST['nom'];
  $prenom = trim($_POST['prenom']);
  $numero = trim($_POST['numero']);
  $adresse = $_POST['adresse'];
  $email = $_POST['email'];
  $password = SignModel::HashNTrim($_POST["mot_de_passe"]);


  AccountPageModel::UpdateAccountInfos($nom, $prenom, $numero, $adresse, $email, $password);

}

if (isset($_POST["submit-pdf"])) {
  include("AccountPageModel.php");
  session_start();

  AccountPageModel::pdf();
}

header('location:./');
?>
