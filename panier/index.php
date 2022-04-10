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
    ?>
    <div class="mx-auto" style="width: 60rem; height: 500px; display: block;">

      <div class="d-flex justify-content-between d-flex align-items-end mb-3">

        <h1 translate-key="cart-desc"></h1>
        <div class="d-flex">
          <h2 class="mx-2" translate-key="cart-price"></h2>
          <h2 id="prix_total"></h2>
        </div>
      </div>
       <ul class="list-group rounded-3 gap-3">
         <?php
          require_once("PanierModel.php");
          $UserId = $_SESSION['id_utilisateur'];
          $prix_total = 0;

          $req = PanierModel::SelectProducts($UserId);

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
               <img src="<?php echo "/img/products/".$row->image; ?>" width="100" height="100">
               <p><?php echo $row->nom; ?></p>
               <p><?php echo $prix / $row->quantite . " €"; ?></p>
               <p><?php echo $row->reduction . "%"; ?></p>
               <form action="manageQuantity.php" method="post" class="d-flex flex-column">
                 <input type = "text" name = "idProduit" value = "<?php echo $row->id_produit; ?>" hidden>
                 <input type="submit" name="plus"
                  class="btn btn-primary" value="+" onclick=""/>

                 <p><?php echo $row->quantite; ?></p>

                 <input type="submit" name="minus"
                  class="btn btn-primary" value="-" />
               </form>
               <form action=<?php echo "deleteProduct.php?id=".$row->id_produit ?> method="post" class="d-flex flex-column">
                 <button type="submit" name="delete_submit" class="btn btn-danger" translate-key="delete-button"></button>
               </form>
             </li>

             <?php } ?>
          <div class="d-flex justify-content-end">
            <?php if ($req->rowCount() > 0) { ?>
              <button type="button" onclick="startStripe()" class="btn btn-success" translate-key="cart-button"></button>
            <?php } ?>
          </div>
          <script>
          //Edit total price
            var prix = <?php echo json_encode($prix_total . "€"); ?>;
            document.getElementById("prix_total").innerHTML += prix;

            function startStripe(){
              window.location.href='loadStripe.php';
            }
          </script>
       </ul>
    </div>
    <?php
      include("../includes/footer.php");
    ?>
  </body>
</html>
