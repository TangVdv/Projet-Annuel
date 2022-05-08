<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Votre compte</title>
  </head>
  <?php
  include("../includes/header.php");
  include("verifUserLogin.php");
   ?>
   <body>
     <div style="width: 100rem" class="container">
       <div class="bg-light py-4 container d-flex">

         <div class="d-flex flex-wrap">

           <div class="text-center">
             <div class="text-center">
               <ul class="list-group rounded-3">
                 <a class="text-decoration-none" href="./">
                   <li class="list-group-item">
                     <p> < <b translate-key="home-title"></b></p>
                   </li>
                 </a>
               </ul>
             </div>
           </div>

           <div class="bg-light py-1 container">
             <ul class="list-group rounded-3">
               <a class="text-decoration-none" href="orderTracking.php">
                 <li class="list-group-item">
                   <b translate-key="order-button-title"></b><br><p translate-key="order-button-desc"></p>
                 </li>
               </a>
               <a class="text-decoration-none" href="accountInfos.php">
                 <li class="list-group-item">
                   <b translate-key="information-button-title"></b><br><p translate-key="information-button-desc"></p>
                 </li>
               </a>
             </ul>
           </div>

         </div>

           <div class="container">
             <div class="text-center m-4">
               <h1>Votre carte de fidélité</h1>
             </div>

            <div class="d-flex justify-content-center">
              <div class="col-md-6">
                <div class="row border rounded-3 shadow text-light" style="background-color: #004579">
                  <div class="text-center">
                    <img src="/img/logo_loyaltycard.png" width="200" height="80" alt="">
                  </div>

                  <!-- Left side -->
                  <div class="col d-flex flex-column position-static m-4">
                    <?php
                    include("AccountPageModel.php");
                    AccountPageModel::qrCode();
                    $res = AccountPageModel::DisplayAccountInfos();

                    $row = $res->fetch(PDO::FETCH_OBJ);

                    ?>
                    <img src=<?php echo "../img/qrcode/qrcode-".$row->hash_id.".png"?> height="120", width="120">
                  </div>

                  <!-- Right side -->
                  <div class="col d-flex flex-column position-static text-end">
                     <p><?php echo $row->prenom." ".$row->nom?></p>
                     <p class="m-0"><?php echo $row->adresse ?></p>
                     <p><?php echo $row->email ?></p>
                     <p><?php echo $row->numero ?></p>
                  </div>

                </div>
              </div>

            </div>
            <div class="m-4 text-end">
              <form action="updateAccount.php" method="post">
                <button type="submit" class="btn btn-primary" name="submit-pdf">Télécharger au format pdf</button>
              </form>
            </div>

           </div>




       </div>


     </div>
   </body>

</html>
