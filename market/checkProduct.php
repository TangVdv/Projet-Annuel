<?php
if (isset($_POST["market-submit"])) {
  include("marketModel.php");
  session_start();
  $exist = MarketModel::SelectSpecificProduct();
  if ($exist == 0) {
    MarketModel::InsertProduct();
  }
  else {
    MarketModel::UpdateProduct();
  }
}

header("location:./");

 ?>
