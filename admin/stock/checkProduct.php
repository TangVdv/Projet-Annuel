<?php
include("../includes/checkAdmin.php");
include('stockModel.php');

// DELETE
if (isset($_POST["delete_submit"])) {
  stockModel::deleteProductFromStock();
}

// ADD
else {
  stockModel::addProductToStock();
}
 ?>
