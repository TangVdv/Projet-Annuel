<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
    <link href="../Site_Public/Bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <?php include("../includes/header.php"); ?>
  <body>
    <div class="w-50 col flex-wrap" style="margin: auto;">
      <a href="Account/index.php" class="nav-link mx-3"><h4>Account</h4></a>
      <a href="Product/index.php" class="nav-link mx-3"><h4>Product</h4></a>
      <a href="Compagny/index.php" class="nav-link mx-3"><h4>Compagny</h4></a>
    </div>

  </body>
</html>
