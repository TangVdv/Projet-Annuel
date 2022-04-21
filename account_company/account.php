<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>company account</title>
  </head>
  <?php
  include("../includes/header.php");
   ?>
  <body>
    <div class="d-flex justify-content-center">
      <?php
      include("productModelCompany.php");
      $res = productModelCompany::getChiffreAffaire();
      while ($row = $res->fetch(PDO::FETCH_OBJ)){
        ?>
        <div class="text-primary">Votre dernier chiffre d'affaire déclaré est de :<?php echo $row->chiffre_affaire; ?>€</div>
      <?php } ?>
      <form class="" action="" method="post">

      </form>



    </div>
  </body>
  <?php
  //include("../includes/footer.php");
  ?>
</html>
