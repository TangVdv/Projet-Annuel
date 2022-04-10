<?php
include("marketModel.php");
$res = MarketModel::SelectProduct($_POST['radioValue']);
while ($row = $res->fetch(PDO::FETCH_OBJ)) {
?>
    <div class="row mb-2">
      <div class="col m-4">
        <div class="col g-0 border rounded mb-4 shadow-sm">
          <div class="text-center">
            <div>
              <h4 class="m-2"><?php echo $row->nom; ?></h4>
              <img class="rounded img-fluid" src=<?php echo "/img/products/".$row->image; ?> alt="">
              <p class="fst-italic text-start mx-1 <?php echo ($row->type=="service")?"echo text-success":"text-primary" ?>"><?php echo $row->type ?></p>
            </div>
            <div class="col d-flex flex-column position-static">
                <div class="mb-1 text-muted "><?php echo $row->description; ?></div>
              </div>
          </div>
          <hr>
          <div class="d-flex justify-content-between m-2">
            <div class="text-center">
              <strong class="d-inline-block mb-2 mt-2 text-secondary"><?php echo $row->prix." €"; ?></strong>
            </div>
            <div>
              <?php if ($row->stock <= 0) {?>
                <button type="button" class="btn btn-primary disabled" translate-key="outofstock-button">Out of stock</button>
              <?php }else{?>
                <form action=<?php echo "checkProduct.php?id_produit=".$row->id_produit; ?> method="post">
                  <button type="submit" class="btn btn-primary" name="market-submit" translate-key="market-button">Add to cart</button>
                </form>
              <?php } ?>
            </div>
          </div>

        </div>
      </div>
    </div>
<?php } ?>
