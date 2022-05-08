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
          <span translate-key="your-company"></span>
          <span><b><?php echo $row->nom?></b></span>
        </h1>
        <?php
          $res = productModelCompany::checkPaymentStatus();
          while ($row = $res->fetch(PDO::FETCH_OBJ)){
            if($row->statut_cotisation == 0){ //L'entreprise n'a pas encore payé
              ?>
              <div class="container text-center rounded-3 py-3">
                <h5 class="text-warning" translate-key="notcontributioncompagny-title"></h5>
              </div>

              <div class="d-flex justify-content-center">
                <button type="button" onclick="startStripe()" class="btn btn-success" translate-key="payment-access"></button>
              </div>
              <?php
            }elseif ($row->statut_cotisation == 1) { //L'entreprise a payé
              ?>
              <h3 class="text-success" translate-key="contributioncompagny-title"></h3>
              <?php
            }else { //==2, L'entreprise a raté une échéance et doit donc payer
              ?>
              <h3 class="text-danger" translate-key="danger-contribution"></h2>
              <div class="d-flex justify-content-center">
                <button type="button" onclick="startStripe()" class="btn btn-success" translate-key="payment-access"></button>
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
            <span class="text-primary" translate-key="lastturnover-title"></span>
            <span><b><?php echo $row->chiffre_affaire; ?> €</b></span>
          </h3>
        </div>
      <?php } ?>

      <form class="text-center" action="updateCA.php" method="post">
        <input type="text" name="CA" value="" placeholder="" translate-key="turnover-title">
        <button type="submit" class="btn btn-success" translate-key="modify-button"></button>
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
