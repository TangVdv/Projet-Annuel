<?php
include('compagnyModel.php');

if(!isset($_POST["name"]) || empty($_POST["name"])){
  header("location:addProduct.php?message=Veuillez renseigner le nom de l'entreprise");
  die;
}

if(!isset($_POST["price"]) || empty($_POST["turnover"])){
  header("location:addProduct.php?message=Veuillez renseigner le chiffre d'affaire de l'entreprise");
  die;
}

compagnyModel::AddCompagny([
  "name" => $name,
  "turnover" => $turnover
]);

?>
