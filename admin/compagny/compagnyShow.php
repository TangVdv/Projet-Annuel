<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
  </head>
  <?php include("../includes/header.php"); ?>
  <body>
    <a href="index.php" class="nav-link ms-4" style="width:10%" translate-key="back-button"></a>
    <?php
    include("compagnyModel.php");
    $res = CompagnyModel::selectSpecificCompagny();
    $row = $res->fetch(PDO::FETCH_OBJ);
     ?>
    <div class="text-center m-4">
      <h2><?php echo $row->nom ?></h2>
    </div>
    <div class="d-flex align-self-center">
   </div>
    <hr>
    <h4 class="m-4" translate-key="productcompagny-title"></h4>
    <div class="d-flex flex-wrap border border-1 rounded m-4">
      <div class="mx-4">
            <?php
            $res = CompagnyModel::selectProductAsCompagny();
            while ($row = $res->fetch(PDO::FETCH_OBJ)) {
            ?>
            <div id=<?php echo $row->id_produit; ?> class='text-center btn' data-bs-toggle="modal" data-bs-target=<?php echo "#modal-".$row->id_produit?>>
              <div class='card mb-4 shadow-sm'>
                <img src=<?php echo "../../img/products/".$row->image; ?> width='200px' height='200px'>
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
