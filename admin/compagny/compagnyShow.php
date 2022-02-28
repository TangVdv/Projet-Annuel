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
    <?php
    include("compagnyModel.php");
    $res = compagnyModel::selectSpecificCompagny();
    $row = $res->fetch(PDO::FETCH_OBJ);
     ?>
    <div class="text-center m-4">
      <h2><?php echo $row->nom ?></h2>
    </div>
    <hr>
    <h4 class="m-4">Tous les produits dont dispose l'entreprise : </h4>
    <div class="d-flex flex-wrap border border-1 rounded m-4">
      <div class="mx-4">
            <?php
            $res = compagnyModel::selectProductAsCompagny();
            while ($row = $res->fetch(PDO::FETCH_OBJ)) {
            ?>
            <div id=<?php echo $row->id_produit; ?> class='text-center btn'>
              <div class='card mb-4 shadow-sm'>
                <img src=<?php echo "../../Site_Public/img/products/".$row->image; ?> width='200px' height='200px'>
                <div class='card-body p-0'>
                  <div class='card-text'>
                    <p class='m-0' style='width: 200px; word-wrap: break-word;'><?php echo $row->nom; ?></p>
                  </div>
                  <div class='card-footer text-muted p-1'>
                    <p class='m-0'><?php echo $row->prix." €"; ?></p>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
      </div>
    </div>
  </body>
</html>
