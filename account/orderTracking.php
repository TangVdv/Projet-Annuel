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

        <div class="d-flex bg-light py-1 container">
          <div class="w-25 text-center">
            <ul class="list-group rounded-3 w-50">
              <a class="text-decoration-none" href="account.php">
                <li class="list-group-item">
                  <p>< <b>Accueil</b></p>
                </li>
              </a>
            </ul>
          </div>

          <div class="w-75 container text-center rounded-3 py-1">
            <h1 class="h3">Votre dernière commande</h1>

            <div class="d-flex flex-wrap container justify-content-between align-items-center bg-white border">
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
            <li class="list-group-item">
              <p><b>Mes commandes </b> <br>Suivre, annuler, retourner</p>
            </li>
            <li class="list-group-item">
              <p><b>Mes informations personnelles </b> <br>Email, mot de passe...</p>
            </li>
          </ul>
        </div>

      </div>


    </div>
  </body>

</html>
