<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../lib/bootstrap.min.css">
  </head>
  <body>
    <?php
    include("../includes/header.php");
     ?>
    <main>
      <div class="row row-cols-md-3 justify-content-center">
        <?php
        include("marketModel.php");
        $res = addToCartModel::SelectProduct();
        while ($row = $res->fetch(PDO::FETCH_OBJ)) {
        ?>
            <div class="row mb-2">
              <div class="col m-4">
                <div class="col g-0 border rounded mb-4 shadow-sm">
                  <div class="text-center">
                    <div class="col">
                      <img class="bd-placeholder-img" width="300" height="400" src=<?php echo "../image/products/".$row->image; ?> alt="">
                    </div>
                    <div class="col p-4 d-flex flex-column position-static">
                        <h4 class="mb-0"><?php echo $row->nom; ?></h4>
                        <div class="mb-1 text-muted">Description</div>
                        <strong class="d-inline-block mb-2 mt-2 text-secondary"><?php echo $row->prix." €"; ?></strong>
                      </div>
                  </div>
                  <div class="text-end m-2">
                      <a type="button" class="btn btn-primary" href=<?php echo 'checkProduct.php?id_produit='.$row->id_produit.'&id_panier=1' ?>>Ajouter au panier</a>
                      <?php
                        //addToCartModel::InsertProduct(['id_produit' => $row->id_produit, 'id_panier' => 1])
                       ?>
                  </div>
                </div>
              </div>
            </div>
        <?php
        }
        ?>
      </div>
    </main>
    <?php
    include("../includes/footer.php");
     ?>
  </body>
</html>
