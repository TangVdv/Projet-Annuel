<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Vos informations personnelles</title>
  </head>
  <?php
  include("../includes/header.php");
  include("verifUserLogin.php");
  ?>
  <body>
    <div class="w-50" style="margin: auto;">
        <h3 class="my-4" translate-key="form-title"></h3>
        <form class="" action="updateAccount.php" method="post" enctype="multipart/form-data">
          <?php
          include("AccountPageModel.php");

          $res = AccountPageModel::DisplayAccountInfos();
          while($row = $res->fetch(PDO::FETCH_OBJ)){
          ?>
          <div class="mb-3">
            <label class="form-label" translate-key="lastname-input"></label>
            <input type="text" class="form-control" value="<?=$row->nom?>" name="nom" id="nom">
          </div>
          <div class="mb-3">
            <label class="form-label" translate-key="firstname-input"></label>
            <input type="text" class="form-control" id="prenom" value="<?=$row->prenom?>" name="prenom"></input>
          </div>
          <div class="mb-3">
            <label class="form-label" translate-key="phone-input"></label>
            <input type="number" class="form-control" value="<?=$row->numero?>" name="numero" id="numero">
          </div>
          <div class="mb-3">
            <label class="form-label" translate-key="address-input"></label>
            <input type="text" class="form-control" value="<?=$row->adresse?>" name="adresse" id="adresse">
          </div>
          <div class="mb-3">
            <label class="form-label" translate-key="email-input"></label>
            <input type="text" class="form-control" value="<?=$row->email?>" name="email" id="email">
          </div>
          <div class="mb-3">
            <label class="form-label" translate-key="password-input"></label>
            <input type="password" class="form-control" placeholder="( ͡° ͜ʖ ͡°)" name="mot_de_passe" id="mot_de_passe">

            </select>
          </div>
          <div>
            <p class="text-danger">
            <?php
              if(isset($_GET["message"]) || !empty($_GET["message"])){
                  echo $_GET["message"];
              }
            ?>
            </p>
          </div>
          <div class="mb-3 w-25">
              <button type="submit" class="form-control btn btn-primary" id="submit_modif" name="submit-button" translate-key="submit-button"></button>
          </div>
        <?php } ?>
        </form>


        <a href="./" class="nav-link my-4 p-0" style="width:10%" translate-key="back-button"></a>

    </div>
  </body>
</html>
