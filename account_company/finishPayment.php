<?php

session_start();
//Le paiment a été effectué
include("PaymentModel.php");
PaymentModel::updatePaymentStatus();

header("location:account.php");

 ?>
