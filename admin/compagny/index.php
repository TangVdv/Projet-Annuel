<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
    <link href="../../Site_Public/Bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <?php include("../../includes/header.php"); ?>
  <body>
    <div class="w-50 col flex-wrap" style="margin: auto;">
      <?php
      include("compagnyModel.php");

      $res = compagnyModel::selectCompagny();

      while($row = $res->fetch(PDO::FETCH_OBJ)){ ?>
        <div class="">
          <a href=<?php echo "compagnyShow.php?id=".$row->id_entreprise; ?> class="nav-link mx-3"><h4><?php echo $row->nom; ?></h4></a>
        </div>
      <?php } ?>
    </div>
  </body>
</html>
