<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Votre compte</title>
  </head>
  <?php
  include("../includes/header.php");

  include("../includes/bdd.php");
   ?>
  <body>
    <div style="width: 100rem" class="container">
      <div class="bg-light py-4 container d-flex flex-column">

        <div class="d-flex flex-wrap">
          <div class="w-25 text-center">
      <?php
            include("AccountPageModel.php");
            $res = AccountPageModel::DisplayName();
            while ($row = $res->fetch(PDO::FETCH_OBJ)) {
            ?>
            <img src="../img/icon.jpg" class="img-fluid rounded-circle" width="200" height="200"><br>
            <div class="d-flex justify-content-center">
              <h3 class="mx-2" translate-key="hello-title"></h3>
              <p class="h3 mx-2"><b><?php echo $row->nom?></b></p>
            </div>
      <?php } ?>
          </div>

          <div class="w-75 container text-center rounded-3 py-1">
            <h1 class="h3" translate-key="lastorder-title"></h1>

            <div class="d-flex flex-wrap container justify-content-between align-items-center border" style="background-color: #eaf9ff">
              <?php
                $res = AccountPageModel::DisplayLastOrder();
                while ($row = $res->fetch(PDO::FETCH_OBJ)) { ?>
                <img src=<?php echo "../img/products/".$row->image; ?> width="250" height="150">
                <p><?php echo $row->nom?></p>
                <p><?php echo $row->date_achat?></p>
                <p><?php echo $row->prix_achat . " €"?> | x <?php echo $row->quantite ?></p>
              <?php } ?>
            </div>
          </div>
        </div>


        <br>

        <div class="bg-light py-1 container">
          <ul class="list-group rounded-3 w-25">
            <a class="text-decoration-none" href="orderTracking.php">
              <li class="list-group-item">
                <b translate-key="order-button-title"></b><br><p translate-key="order-button-desc"></p>
              </li>
            </a>
            <a class="text-decoration-none" href="accountInfos.php">
              <li class="list-group-item">
                <b translate-key="information-button-title"></b><br><p translate-key="information-button-desc"></p>
              </li>
            </a>
            <a class="text-decoration-none" href="#">
              <li class="list-group-item">
                <b translate-key="loyaltycard-button-title"></b><br><p translate-key="loyaltycard-button-desc"></p>
              </li>
            </a>
          </ul>
        </div>



      </div>


    </div>
  </body>

</html>
