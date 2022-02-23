<?php
include("marketModel.php");
addToCartModel::InsertProduct(['id_produit' => $_GET['id_produit'], 'id_panier' => $_GET['id_panier']]);
header("location:index.php");

 ?>
