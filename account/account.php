<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
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
            <img src="../img/icon.jpg" class="img-fluid rounded-circle" width="200" height="200"><br>
            <h1 class="h3">Bonjour <b>Client,</b></h1 class="h3">
            <p>Vous êtes avec nous depuis X jours !</p>
          </div>

          <div class="w-75 container text-center rounded-3 py-1">
            <h1 class="h3">Votre dernière commande</h1>

            <div class="d-flex flex-wrap container justify-content-between align-items-center bg-white border">
              <?php
                include("accountModel.php");
                $res = accountModel::DisplayLastOrder();
               ?>
              <img src="../img/icon.jpg" width="250" height="150">
              <p class="">Nom :</p>
              <p>Commandé le : </p>
              <p>Prix : | Quantité :</p>
            </div>
          </div>
        </div>


        <br>

        <div class="bg-light py-1 container">
          <ul class="list-group rounded-3 w-25">
            <a class="text-decoration-none" href="orderTracking.php">
              <li class="list-group-item">
                <p><b>Mes commandes </b> <br>Suivre, annuler, retourner</p>
              </li>
            </a>
            <a class="text-decoration-none" href="#">
              <li class="list-group-item">
                <p><b>Mes informations personnelles </b> <br>Email, mot de passe...</p>
              </li>
            </a>
          </ul>
        </div>



      </div>


    </div>
  </body>

</html>
