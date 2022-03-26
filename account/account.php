<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <?php
  include("../includes/header.php");
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

          <div class="w-75 container text-center bg-white rounded-3 border py-1">
            <h1 class="h3">Votre dernière commande</h1>
            <div class="d-flex flex-wrap justify-content-between align-items-center">
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
            <li class="list-group-item">
              <p><b>Mes commandes </b> <br>Suivre, annuler, retourner</p>
            </li>
          </ul>
        </div>



      </div>


    </div>
  </body>

</html>
