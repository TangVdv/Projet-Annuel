<!DOCTYPE html>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Panier</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
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
    <div class="mx-auto border border-primary" style="background: #2F91E4; width: 500px; height: 500px; display: block;">
      <?php
        /*
        $req = 'SELECT image, nom, prix, reduction
                  FROM PRODUIT
                  INNER JOIN ACHETE ON produit.id_produit = achete.id_produit
                  INNER JOIN UTILISATEUR ON achete.id_utilisateur = 1 ';*/

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
        }

       ?>
       <div class="d-flex flex-column bd-highlight mb-3">
         <div class="d-flex bd-highlight">
           <img src="" alt="">
           <div class="w-50 p-2 flex-grow-1 bd-highlight border border-primary">Nom</div>
           <div class="w-25 p-2 bd-highlight border border-primary">11,11€</div>
           <div class="w-15 p-2 bd-highlight border border-primary">41,11%</div>
         </div>
          <div class="p-2 bd-highlight border border-primary">Flex item 2</div>
          <div class="p-2 bd-highlight border border-primary">Flex item 3</div>
        </div>

    </div>
  </body>
</html>
