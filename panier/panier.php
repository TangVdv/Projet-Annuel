<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Panier</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style="background: #EAF9FF">
    <?php
      include("../includes/header.php");

      include("db_connection.php");
      //Display errors
      /*
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
      */

    ?>
    <div class="mx-auto" style="width: 60rem; height: 500px; display: block;">

      <div class="d-flex justify-content-between d-flex align-items-end">
        <?php
          $req = 'SELECT prix_total
                      FROM PANIER
                      WHERE id_utilisateur = 1';
          $req = $db->query($req);
          $row = $req->fetch(PDO::FETCH_OBJ);
          $prix_total = $row->prix_total;

         ?>
        <h1 class="">Votre panier :</h1>
        <h2>Total : <?php echo $prix_total . "€" ?></h2>
      </div>
      <?php
        include("manageQuantity.php");
       ?>


       <ul id="liste" class="list-group rounded-3">
         <?php
          $doc = new DOMDocument();
          $liste = $doc->getElementById("liste");

          $req = 'SELECT produit.id_produit, image, nom, prix, reduction, quantite
                    FROM PRODUIT
                    INNER JOIN ACHETE ON produit.id_produit = achete.id_produit
                    WHERE achete.id_utilisateur = 1';
          $req = $db->query($req);

           while ($row = $req->fetch(PDO::FETCH_OBJ)){
             ?>
             <li class="list-group-item d-flex justify-content-between align-items-center">
               <img src="<?php echo "../image/products/".$row->image; ?>">
               <p><?php echo $row->nom; ?></p>
               <p><?php echo $row->prix . " €"; ?></p>
               <p><?php echo $row->reduction . "%"; ?></p>
               <div class="d-flex flex-column">
                 <button type="button" class="btn btn-primary" onclick="increaseQuantity(<?php echo $row->id_produit; ?>);">+</button>
                 <p><?php echo $row->quantite; ?></p>
                 <button type="button" class="btn btn-primary" onclick="decreaseQuantity(<?php echo $row->id_produit; ?>)">-</button>
               </div>
               <button href=<?php echo "deleteProduct.php?id=".$row->id_produit; ?> type="button" class="btn btn-danger" onclick="">Supprimer</button>
             </li>

             <?php
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
    <?php
      include("../includes/footer.php");
    ?>
  </body>
</html>
