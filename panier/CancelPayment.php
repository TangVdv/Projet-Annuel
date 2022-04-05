<?php
include("PanierModel.php");

session_start();
$current_UID = $_SESSION["id_utilisateur"];

PanierModel::CancelPayment($current_UID);

header("location:./")


 ?>
