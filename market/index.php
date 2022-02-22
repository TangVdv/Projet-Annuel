<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../lib/bootstrap.min.css">
  </head>
  <body>
    <header class="site-header sticky-top py-1 bg-dark">
      <nav class="d-flex justify-content-center">
        <h1 class="text-light">HEADER</h1>
      </nav>
    </header>
    <main>
      <div class="row row-cols-md-3 justify-content-center">
        <?php
        include("../includes/bdd.php");
        $db = OpenDb();
        $res = SelectAll("Produit", $db);
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
                      <a href=<?php echo "check_addToCart.php?id=".$row->id_produit; ?> type="button" class="btn btn-primary">Ajouter au panier</a>
                  </div>
                </div>
              </div>
            </div>
        <?php
        }
        ?>
      </div>
    </main>
  </body>
</html>
