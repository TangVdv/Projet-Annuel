<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Votre compte</title>
  </head>
  <?php
  include("../includes/header.php");
   ?>
  <body>
    <div style="width: 100rem" class="container">
      <div class="bg-light py-4 container d-flex flex-column">

        <div class="d-flex flex-wrap">
          <div class="w-25 text-center">
      <?php
            include("AccountPageModel.php");
            $res = AccountPageModel::DisplayName();
            $row = $res->fetch(PDO::FETCH_OBJ) ?>
            <img src="../img/icon.jpg" class="img-fluid rounded-circle" width="200" height="200"><br>
            <div class="d-flex justify-content-center">
              <h3 class="mx-2" translate-key="hello-title"></h3>
              <p class="h3 mx-2"><b><?php echo $row->nom?></b></p>
            </div>
          </div>

          <div class="w-75 container text-center rounded-3 py-1">
            <h1 class="h3" translate-key="lastorder-title"></h1>
              <table class='table table-striped'>
                <thead class='text-center'>
                  <tr>
                    <th translate-key="image-title"></th>
                    <th translate-key="name-title"></th>
                    <th translate-key="date-title"></th>
                    <th translate-key="price-title"></th>
                    <th translate-key="stock-title"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $res = AccountPageModel::DisplayLastOrder();
                    $row = $res->fetch(PDO::FETCH_OBJ); ?>
                  <tr>
                    <td><img src=<?php echo "/img/products/".$row->image; ?> width="100" height="100"></td>
                    <td><?php echo $row->nom?></td>
                    <td><?php echo $row->date_achat?></td>
                    <td><?php echo $row->prix_achat . " €"?></td>
                    <td><?php echo $row->quantite ?></td>
                    <td>
                      <form action="Return/return.php" method="post">
                        <input type = "text" name = "idProduit" value = "<?php echo $row->id_produit; ?>" hidden>
                        <input type = "text" name = "idHistorique" value = "<?php echo $row->id_historique; ?>" hidden>
                        <input type="submit" name="return_submit" class="btn btn-success" value="Renvoyer"></input>
                      </form>
                    </td>
                  </tr>
                </tbody>
              </table>
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
            <a class="text-decoration-none" href="loyaltycard.php">
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
