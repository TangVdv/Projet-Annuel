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
              <a class="text-decoration-none" href="#">
                <li class="list-group-item">
                  <b translate-key="loyaltycard-button-title"></b><br><p translate-key="loyaltycard-button-desc"></p>
                </li>
              </a>
            </ul>
          </div>

        </div>

          <div class="w-75 container text-center rounded-3 py-1">
            <h1 class="h3">Votre carte de fidélité</h1>
            <p>Scannez ce code barre pour afficher votre carte de fidélite !</p>
          </div>

      </div>


    </div>
  </body>

</html>
