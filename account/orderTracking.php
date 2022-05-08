<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Votre compte</title>
  </head>
  <?php
  include("../includes/header.php");
  include("verifUserLogin.php");
   ?>


  <body>
    <div style="width: 100rem" class="container">
      <div class="bg-light py-4 container d-flex">

        <div class="d-flex flex-wrap">

          <div class="text-center">
            <div class="text-center">
              <ul class="list-group rounded-3">
                <a class="text-decoration-none" href="./">
                  <li class="list-group-item">
                    <p> < <b translate-key="home-title"></b></p>
                  </li>
                </a>
              </ul>
            </div>
          </div>

          <div class="bg-light py-1 container">
            <ul class="list-group rounded-3">
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

          <div class="w-75 container text-center rounded-3 py-1">
            <h1 class="h3" translate-key="currentorder-title"></h1>
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
                  include("AccountPageModel.php");
                  $res = AccountPageModel::DisplayOrders();
                  while ($row = $res->fetch(PDO::FETCH_OBJ)) { ?>
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
                <?php } ?>
              </tbody>
            </table>
          </div>




      </div>


    </div>
  </body>

</html>
