<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Panier</title>
    <script src="https://js.stripe.com/v3/"></script>
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
          require_once("PanierModel.php");
          $UserId = $_SESSION['id_utilisateur'];
          $prix_total = 0;

          /*
          //Sélectionne tous les produits dans le panier de l'utilisateur
          $req = $db->prepare('SELECT produit.id_produit, image, nom, prix, reduction, quantite
                                FROM PRODUIT
                                INNER JOIN ACHETE ON produit.id_produit = achete.id_produit
                                WHERE achete.id_utilisateur = :id_utilisateur');
                 $req->execute([
                   "id_utilisateur" => $_SESSION['id_utilisateur']
                 ]);*/
          $req = PanierModel::SelectProducts($UserId);
          $myClass = new PanierModel();



           while ($row = $req->fetch(PDO::FETCH_OBJ)){
             //Calcul du prix total mis à jour à chaque row
             if($row->reduction > 0){
               $prix = ($row->prix - $row->prix / $row->reduction) * $row->quantite;
             }
             else {
               $prix = $row->prix * $row->quantite;
             }
             $prix_total += $prix;
             ?>
             <li class="list-group-item d-flex justify-content-between align-items-center">
               <img src="<?php echo "../img/products/".$row->image; ?>" width="100" height="100">
               <p><?php echo $row->nom; ?></p>
               <p><?php echo $prix / $row->quantite . " €"; ?></p>
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

             <?php } ?>
          <div class="d-flex justify-content-end">
            <?php if ($req->rowCount() > 0) {
              include("stripeSetup.php"); ?>
              <button type="button" onclick="startStripe()" class="btn btn-success">Finaliser la commande</button>
          </div>
          <script>
          //Edit total price
            var prix = <?php echo json_encode("Prix total : " . $prix_total . "€"); ?>;
            document.getElementById("prix_total").innerHTML = prix;

            function startStripe(){
              let result="<?php PanierModel::UpdateBuyingStatus($_SESSION["id_utilisateur"]); ?>";

              //Redirect to Stripe API
              let stripe = Stripe('pk_test_51KkUMrEAVKGv2IR8nSGCaofWHp39rz8HpyLpVDZww9MRMmYDzROT7q2XjqURjygjVKF3zTmm53SdsrucbwY5XoRQ00L3pUicbq');

              stripe.redirectToCheckout({
                sessionId: "<?php echo $session->id; ?>"
              });
            }
          </script>
       </ul>
    </div>
    <?php
      include("../includes/footer.php");
    ?>
  </body>
</html>
