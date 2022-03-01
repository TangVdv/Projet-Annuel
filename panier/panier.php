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
        <h2 id="prix_total"></h2>
      </div>
      <?php
        //include("manageQuantity.php");
       ?>


       <ul id="liste" class="list-group rounded-3">
         <?php
          $prix_total = 0;
          $doc = new DOMDocument();
          $liste = $doc->getElementById("liste");

          $req = 'SELECT produit.id_produit, image, nom, prix, reduction, quantite
                    FROM PRODUIT
                    INNER JOIN ACHETE ON produit.id_produit = achete.id_produit
                    WHERE achete.id_utilisateur = 1';
          $req = $db->query($req);

           while ($row = $req->fetch(PDO::FETCH_OBJ)){
             $prix_total += ($row->prix - $row->prix / $row->reduction) * $row->quantite;
             ?>
             <li class="list-group-item d-flex justify-content-between align-items-center">
               <img src="<?php echo "../image/products/".$row->image; ?>">
               <p><?php echo $row->nom; ?></p>
               <p><?php echo ($row->prix - $row->prix / $row->reduction) * $row->quantite . " €"; ?></p>
               <p><?php echo $row->reduction . "%"; ?></p>
               <form action="quantity/manageQuantity.php" method="post" class="d-flex flex-column">
                 <input type = "text" name = "idProduit" value = "<?php echo $row->id_produit; ?>" hidden>
                 <input type="submit" name="plus"
                  class="btn btn-primary" value="+" onclick=""/>

                 <p id=""><?php echo $row->quantite; ?></p>

                 <input type="submit" name="minus"
                  class="btn btn-primary" value="-" />
               </form>
               <form action="deleteProduct.php" method="post" class="d-flex flex-column">
                 <input type = "text" name = "idProduit" value = "<?php echo $row->id_produit; ?>" hidden>
                 <input type="submit" name="Suppr"
                  class="btn btn-danger" value="Supprimer" onclick=""/>
               </form>
             </li>

             <?php
           }
           $req = $db->prepare('UPDATE PANIER SET prix_total = :prix_total WHERE id_utilisateur = :id_utilisateur');
           $req->execute([
             "prix_total" => $prix_total,
             "id_utilisateur" => "1"
           ]);
          ?>

          <script>
          //Edit total price
            var prix = <?php echo json_encode($prix_total . "€"); ?>;
            document.getElementById("prix_total").innerHTML = prix;
          </script>
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
