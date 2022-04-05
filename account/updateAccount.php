<?php
include("../SignIn-Up/signModel.php");
include("AccountPageModel.php");

session_start();

$id_utilisateur = $_SESSION['id_utilisateur'];
$nom =	$_POST['nom'];
$prenom = trim($_POST['prenom']);
$numero = trim($_POST['numero']);
$adresse = $_POST['adresse'];
$email = $_POST['email'];
$password = SignModel::HashNTrim();


AccountPageModel::UpdateAccountInfos($id_utilisateur, $nom, $prenom, $numero, $adresse, $email, $password);

header('location:account.php');
?>
