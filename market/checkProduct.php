<?php
include("marketModel.php");
addToCartModel::InsertProduct($_GET['id_produit']);
header("location:index.php");

 ?>
