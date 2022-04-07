<?php
include("../includes/checkAdmin.php");
include('serviceModel.php');

// ADD
if(isset($_POST["add_submit"])){

  if(!isset($_POST["name"]) || empty($_POST["name"])){
    header("location:addService.php?message=Veuillez renseigner le nom du produit");
    die;
  }

  if(!isset($_POST["price"]) || empty($_POST["price"])){
    header("location:addService.php?message=Veuillez renseigner le prix du produit");
    die;
  }
  else {
    if ($_POST["price"] < 0) {
      header("location:addService.php?message=Veuillez renseigner un prix valide");
      die;
    }
  }

  if(!isset($_POST["reduction"])){
    header("location:addService.php?message=Veuillez renseigner une réduction");
    die;
  }

  if(!isset($_POST["stock"])){
    header("location:addService.php?message=Veuillez renseigner le nombre de produit en stock");
    die;
  }
  else {
    if ($_POST["price"] < 0) {
      header("location:addService.php?message=Veuillez renseigner un nombre valide");
      die;
    }
  }
  $compagny_id = filter_input(INPUT_POST, 'compagny', FILTER_SANITIZE_STRING);
  if (!isset($compagny_id) || empty($compagny_id)){
    header("location:addService.php?message=Veuillez renseigner une entreprise");
    die;
  }


  if(isset($_FILES['img']) && !empty($_FILES['img']['name'])){

    // Vérifier le type de fichier
    $acceptable = [
      'image/jpeg',
      'image/png',
    ];

    if(!in_array($_FILES['img']['type'], $acceptable)){
        // Redirection vers la page d'inscription avec un message d'erreur
        header('location:addService.php?message=Format de fichier incorrect');
        exit;
    }
    // Vérifier la taille du fichier

    $maxSize = 2 * 1024 * 1024; // 2Mo

    if($_FILES['img']['size'] > $maxSize){
      // Redirection vers la page d'inscription avec un message d'erreur
      header('location:addService.php?message=Le fichier est trop volumineux');
      exit;
    }

    // Chemin vers le dossier d'uploads
    $path = '../../img/services/';

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
    header("location:addService.php?message=Vous devez choisir une image");
    die;
  }

  $image = $filename;

  ServiceModel::AddService([
    "image" => $image,
    "id_entreprise" => $compagny_id,
  ]);
}

// DELETE
if(isset($_POST["delete_submit"])){
  ServiceModel::DeleteService();
}

header("location:./");

?>
