<?php
include("accountModel.php");
accountModel::DeleteAccount($_GET['id']);
header("location:index.php");

 ?>