<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Compte</title>
  </head>
  <?php
  include("../includes/header.php");
  include("verifCompanyLogin.php");
   ?>
  <body>
    <div class="container bg-light py-4 border-bottom">
      <div class="">
        <?php
        require_once("productModelCompany.php");
        $res = productModelCompany::DisplayName();
        $row = $res->fetch(PDO::FETCH_OBJ)
        ?>
        <h1 class="h3">
          <span>Votre entreprise :</span>
          <span><b><?php echo $row->nom?></b></span>
        </h1>
        <?php
          $res = productModelCompany::checkPaymentStatus();
          while ($row = $res->fetch(PDO::FETCH_OBJ)){
            if($row->statut_cotisation == 0){ //L'entreprise n'a pas encore payé
              ?>
              <div class="container text-center rounded-3 py-3">
                <h5 class="text-warning">Vous n'avez pas encore réglé votre paiment de cotisation annuel.</h5>
              </div>

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

    <div class="container bg-light py-4 border-bottom">
      <?php
      $res = productModelCompany::getChiffreAffaire();
      while ($row = $res->fetch(PDO::FETCH_OBJ)){
        ?>
        <div class="container text-center rounded-3 py-3">
          <h3>
            <span class="text-primary">Votre dernier chiffre d'affaires déclaré est de : </span>
            <span><b><?php echo $row->chiffre_affaire; ?> €</b></span>
          </h3>
        </div>
      <?php } ?>

      <form class="text-center" action="updateCA.php" method="post">
        <input type="text" class="form-text" name="CA" value="" placeholder="Dernier chiffre d'affaires">
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
  include("../includes/footer.php");
  ?>
</html>
