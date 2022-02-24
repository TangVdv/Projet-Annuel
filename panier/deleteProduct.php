<?php

  include("db_connection.php");

  $id = $_GET['id']

  $query = $db->prepare("DELETE FROM ACHETE WHERE id_produit = :id;");
  $query->execute([
    "id" => $id
  ]);

  header('Location: panier.php');
  exit;
 ?>
