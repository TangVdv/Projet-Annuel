<?php
session_start();
include('../../includes/bdd.php');

if(isset($_FILES['img']) && !empty($_FILES['img']['name'])){

  // Vérifier le type de fichier
  $acceptable = [
    'image/jpeg',
    'image/png',
  ];

  if(!in_array($_FILES['img']['type'], $acceptable)){
      // Redirection vers la page d'inscription avec un message d'erreur
      header('location:index.php?message=Format de fichier incorrect.');
      exit;
  }
  // Vérifier la taille du fichier

  $maxSize = 2 * 1024 * 1024; // 2Mo

  if($_FILES['img']['size'] > $maxSize){
    // Redirection vers la page d'inscription avec un message d'erreur
    header('location:index.php?message=Le fichier est trop volumineux.');
    exit;
  }

  // Chemin vers le dossier d'uploads
  $path = '../../img/products/';

  // Enregistrement du fichier

  $filename = $_FILES['img']['name'];

  // Renommer l'img
  // img-15464785.ext

  // Récupérer l'extension
  $array = explode('.', $filename);
  $ext = end($array);

  $filename = 'img-' . time() . '.' . $ext;
  // Attention aux doublons si 2 fichiers envoyés dans la même seconde.

  $destination = $path . '/' . $filename;
  move_uploaded_file($_FILES['img']['tmp_name'], $destination);
}
else {
  $filename = "test.png";
}

$name =  $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$stock = $_POST['stock'];

$column = array("nom", "prix", "reduction", "stock");
$value = array($name, $price, 0, $stock);

$db = OpenDb();
InsertValues("produit", $column, $value, $db);

header('location:index.php');
?>