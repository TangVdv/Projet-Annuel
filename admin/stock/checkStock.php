<?php
include("../includes/checkAdmin.php");
include('stockModel.php');

// DELETE PRODUCT
if (isset($_POST["delete_product_submit"])) {
  stockModel::DeleteProductFromStock();
}

// DELETE STOCK
else if (isset($_POST["delete_stock_submit"])) {
  stockModel::DeleteStock();
}

// ADD STOCK
else if (isset($_POST["add_submit"])){
  if(!isset($_POST["name"]) || empty($_POST["name"])){
    header("location:addStock.php?message=Veuillez renseigner le nom de l'entrepôt");
    die;
  }

  if(!isset($_POST["addr"]) || empty($_POST["addr"])){
    header("location:addStock.php?message=Veuillez renseigner l'adresse de l'entrepôt");
    die;
  }

  if(!isset($_POST["phone"]) || empty($_POST["phone"])){
    header("location:addStock.php?message=Veuillez renseigner le numéro de téléphone de l'entrepôt");
    die;
  }

  if(stockModel::IfStockAlreadyExist()){
    header("location:addStock.php?message=Un entrepot existant contient déjà certaines de ces informations");
    die;
  }
  else {
    stockModel::AddStock();
  }
}

// ADD PRODUCT
else {
  stockModel::AddProductToStock();
}

header("location:./");
 ?>
