<?php
include("../includes/checkAdmin.php");
include('compagnyModel.php');

// DELETE
if(isset($_POST["delete_submit"])){
    CompagnyModel::DeleteCompagny();
}

header("location:./");
?>
