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
  $password = SignModel::HashNTrim();


  AccountPageModel::UpdateAccountInfos($nom, $prenom, $numero, $adresse, $email, $password);

}
header('location:./');
?>
