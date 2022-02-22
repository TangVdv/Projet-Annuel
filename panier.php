<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Panier</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style="background: #EAF9FF">
    <?php
      include("db_connection.php");
      //Display errors
      /*
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
      */

    ?>
    <div class="mx-auto" style="width: 60rem; height: 500px; display: block;">


       <h1 class="">Votre panier :</h1>

       <ul id="liste" class="list-group rounded-3">
         <?php
          $doc = new DOMDocument();
          $liste = $doc->getElementById("liste");

           $req = 'SELECT image, nom, prix, reduction
                     FROM PRODUIT
                     INNER JOIN ACHETE ON produit.id_produit = achete.id_produit
                     WHERE achete.id_utilisateur = 1 ';

           foreach ($db->query($req) as $row) {
             /*
             echo $row['image'] . "\n";
             echo $row['nom'] . "\n";
             echo  $row['prix'] . "\n";
             echo $row['reduction'] . "\n";*/
             $image = $row['image'];
             $nom = $row['nom'];
             $prix = $row['prix'];
             $reduction = $row['reduction'];

             $li = $doc->createElement("li");
             $li->setAttribute("class", "list-group-item d-flex justify-content-between align-items-center");
             $liste->appendChild($li);
           }

          ?>
        <!--
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <img src="cart_item.png">
          <p>Nom</p>
          <p>Prix</p>
          <p>Réduction</p>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <img src="cart_item.png">
          <p>Nom</p>
          <p>Prix</p>
          <p>Réduction</p>

        </li>
      -->
       </ul>
    </div>
  </body>
</html>
