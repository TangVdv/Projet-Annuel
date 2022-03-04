<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Panier</title>
  </head>
  <body class="gap-3" style="background: #EAF9FF">
    <?php
      include("../includes/header.php");


      include("../includes/bdd.php");
      //Display errors
      /*
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
      */

    ?>
    <div class="mx-auto" style="width: 60rem; height: 500px; display: block;">

      <div class="d-flex justify-content-between d-flex align-items-end mb-3">

        <h1 class="">Votre panier :</h1>
        <h2 id="prix_total"></h2>
      </div>
       <ul class="list-group rounded-3 gap-3">
         <?php
          $prix_total = 0;
          //Sélectionne tous les produits dans le panier de l'utilisateur
          $req = $db->prepare('SELECT produit.id_produit, image, nom, prix, reduction, quantite
                                FROM PRODUIT
                                INNER JOIN ACHETE ON produit.id_produit = achete.id_produit
                                WHERE achete.id_utilisateur = 1');
                 $req->execute([
                   //"id_utilisateur" => $_SESSION['id_utilisateur']
                 ]);



           while ($row = $req->fetch(PDO::FETCH_OBJ)){
             //Calcul du prix total mis à jour à chaque row
             $prix_total += ($row->prix - $row->prix / $row->reduction) * $row->quantite;
             ?>
             <li class="list-group-item d-flex justify-content-between align-items-center">
               <img src="<?php echo "../img/products/".$row->image; ?>">
               <p><?php echo $row->nom; ?></p>
               <p><?php echo ($row->prix - $row->prix / $row->reduction) * $row->quantite . " €"; ?></p>
               <p><?php echo $row->reduction . "%"; ?></p>
               <form action="quantity/manageQuantity.php" method="post" class="d-flex flex-column">
                 <input type = "text" name = "idProduit" value = "<?php echo $row->id_produit; ?>" hidden>
                 <input type="submit" name="plus"
                  class="btn btn-primary" value="+" onclick=""/>

                 <p><?php echo $row->quantite; ?></p>

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
             //"id_utilisateur" => $_SESSION['id_utilisateur']
           ]);
          ?>
          <div class="d-flex justify-content-end">
            <a class="btn btn-success" href="#">Finaliser la commande</a>
          </div>

          <script>
          //Edit total price
            var prix = <?php echo json_encode("Prix total : " . $prix_total . "€"); ?>;
            document.getElementById("prix_total").innerHTML = prix;
          </script>
       </ul>
    </div>
    <?php
      include("../includes/footer.php");
    ?>
  </body>
</html>
