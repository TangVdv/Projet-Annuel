<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
  </head>
  <?php include("../../includes/header.php"); ?>
  <body>

    <div class="w-50 col flex-wrap" id="article_reload"style="margin: auto;">
      <div class="d-flex justify-content-center">
        <button class='btn btn-success btn-lg m-4' onClick="document.location.href='add_product.php'">Ajouter un Produit</button>
      </div>
    </div>
    <div class="d-flex flex-wrap">
      <div class="mx-4">
          <ul>
            <?php
            include("../../includes/bdd.php");
            $db = OpenDb();
            $res = SelectAll("Produit", $db);
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
          </ul>
      </div>
    </div>

    <script src="../admin.js" charset="utf-8"></script>
    <script src="../../Site_Public/collapse.js" charset="utf-8"></script>
    <script src="../bootstrap.bundle.min.js" charset="utf-8"></script>
  </body>
</html>
