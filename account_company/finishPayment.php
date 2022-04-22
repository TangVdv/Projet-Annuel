<?php

session_start();

include("PaymentModel.php");
PaymentModel::updatePaymentStatus();

header("location:account.php?message=Erreur");

 ?>
