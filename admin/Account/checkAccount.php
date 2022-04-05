<?php
include("../includes/checkAdmin.php");
include("accountModel.php");
if (isset($_POST['delete_submit'])) {
  accountModel::DeleteAccount();
}

header("location:./");

 ?>
