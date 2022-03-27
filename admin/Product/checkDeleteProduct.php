<?php
include("../includes/checkAdmin.php");
include('productModel.php');

if(isset($_GET['id']) && !empty($_GET['id'])){
  productModel::DeleteProduct();
}
 ?>
