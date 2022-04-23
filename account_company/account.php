<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Compte</title>
  </head>
  <?php
  include("../includes/header.php");
   ?>
  <body>
    <div class="d-flex justify-content-center">
      <div class="">
        <?php
          require_once("productModelCompany.php");
          $res = productModelCompany::checkPaymentStatus();
          while ($row = $res->fetch(PDO::FETCH_OBJ)){
            if($row->statut_cotisation == 0){ //L'entreprise n'a pas encore payé
              ?>
              <h3 class="text-warning">Vous n'avez pas encore réglé votre paiment de cotisation annuel.</h3>
              <div class="d-flex justify-content-center">
                <button type="button" onclick="startStripe()" class="btn btn-success">Accéder au paiment</button>
              </div>
              <?php
            }elseif ($row->statut_cotisation == 1) { //L'entreprise a payé
              ?>
              <h3 class="text-success">Vous êtes à jour sur le paiment annuel.</h3>
              <?php
            }else { //==2, L'entreprise a raté une échéance et doit donc payer
              ?>
              <h3 class="text-danger">Vous n'êtes pas à jour sur le paiment de la cotisation annuel, veuillez procéder au paiment pour accéder de nouveau à nos services.</h2>
              <div class="d-flex justify-content-center">
                <button type="button" onclick="startStripe()" class="btn btn-success">Accéder au paiment</button>
              </div>
              <?php
            }
          }
         ?>
      </div>
    </div>
    <div>
      <?php
      //include("productModelCompany.php");
      $res = productModelCompany::getChiffreAffaire();
      while ($row = $res->fetch(PDO::FETCH_OBJ)){
        ?>
        <div class="d-flex justify-content-center">
          <h3 class="text-primary">Votre dernier chiffre d'affaire déclaré est de :<?php echo $row->chiffre_affaire; ?>€</h3>
        </div>
      <?php } ?>
      <form class="d-flex justify-content-center" action="updateCA.php" method="post">
        <input type="text" name="CA" value="" placeholder="Dernier chiffre d'affaire">
        <button type="submit" class="btn btn-success">Modifier</button>
      </form>



    </div>
    <script>
      function startStripe(){
        window.location.href='loadStripeCompany.php';
      }
    </script>
  </body>
  <?php
  //include("../includes/footer.php");
  ?>
</html>
