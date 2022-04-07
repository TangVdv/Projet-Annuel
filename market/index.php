<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="/lib/site.js" charset="utf-8"></script>
  </head>
  <body>
    <?php
    include("../includes/header.php");
     ?>
    <main>
      <div class="d-flex justify-content-center m-4">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" value="produit" onclick="radio()" autocomplete="off" checked>
          <label class="btn btn-outline-primary" for="btnradio1">Produit</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" value="service" onclick="radio()" autocomplete="off">
          <label class="btn btn-outline-success" for="btnradio2">Prestation</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio3" value="both" onclick="radio()" autocomplete="off">
          <label class="btn btn-outline-danger" for="btnradio3">Both</label>
        </div>
      </div>
      <div class="row row-cols-md-4 justify-content-center">
        <?php
        include("marketModel.php");
        $res = MarketModel::SelectProduct();
        while ($row = $res->fetch(PDO::FETCH_OBJ)) {
        ?>
            <div class="row mb-2">
              <div class="col m-4">
                <div class="col g-0 border border-primary rounded mb-4 shadow-sm">
                  <div class="text-center">
                    <div class="col">
                      <img class="bd-placeholder-img" width="250" height="250" src=<?php echo "/img/products/".$row->image; ?> alt="">
                    </div>
                    <div class="col p-4 d-flex flex-column position-static">
                        <h4 class="mb-0"><?php echo $row->nom; ?></h4>
                        <div class="mb-1 text-muted"><?php echo $row->description; ?></div>
                        <strong class="d-inline-block mb-2 mt-2 text-secondary"><?php echo $row->prix." €"; ?></strong>
                      </div>
                  </div>
                  <div class="text-end m-2">
                    <?php if ($row->stock <= 0) {?>
                      <button type="button" class="btn btn-primary disabled" translate-key="outofstock-button"></button>
                    <?php }else{?>
                      <form action=<?php echo "checkProduct.php?id_produit=".$row->id_produit; ?> method="post">
                        <button type="submit" class="btn btn-primary" name="market-submit" translate-key="market-button"></button>
                      </form>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
        <?php
        }

        $res = MarketModel::SelectService();
        while ($row = $res->fetch(PDO::FETCH_OBJ)) {
        ?>
          <div class="row mb-2">
            <div class="col m-4">
              <div class="col g-0 border border-success rounded mb-4 shadow-sm">
                <div class="text-center">
                  <div class="col">
                    <img class="bd-placeholder-img" width="250" height="250" src=<?php echo "/img/services/".$row->image; ?> alt="">
                  </div>
                  <div class="col p-4 d-flex flex-column position-static">
                      <h4 class="mb-0"><?php echo $row->nom; ?></h4>
                      <div class="mb-1 text-muted"><?php echo $row->description; ?></div>
                      <strong class="d-inline-block mb-2 mt-2 text-secondary"><?php echo $row->prix." €"; ?></strong>
                    </div>
                </div>
                <div class="text-end m-2">
                  <?php if ($row->stock <= 0) {?>
                    <button type="button" class="btn btn-primary disabled" translate-key="outofstock-button"></button>
                  <?php }else{?>
                    <form action=<?php echo "checkProduct.php?id_produit=".$row->id_prestation; ?> method="post">
                      <button type="submit" class="btn btn-primary" name="market-submit" translate-key="market-button"></button>
                    </form>
                  <?php } ?>
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
