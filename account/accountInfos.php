<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Vos informations personnelles</title>
  </head>
  <?php include("../includes/header.php"); ?>
  <body>
    <div class="w-50" style="margin: auto;">
        <h3 class="my-4">Vos informations personnelles</h3>
        <form class="" action="checkAddProduct.php" method="post" enctype="multipart/form-data">
          <?php
          include("AccountPageModel.php");

          $res = AccountPageModel::DisplayAccountInfos();
          while($row = $res->fetch(PDO::FETCH_OBJ)){
          ?>
          <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" placeholder="<?=$row->nom?>" name="name" id="name">
          </div>
          <div class="mb-3">
            <label class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" placeholder="<?=$row->prenom?>" name="prenom"></input>
          </div>
          <div class="mb-3">
            <label class="form-label">Numéro</label>
            <input type="number" class="form-control" placeholder="<?=$row->numero?>" name="numero" id="numero">
          </div>
          <div class="mb-3">
            <label class="form-label">Adresse</label>
            <input type="number" class="form-control" placeholder="<?=$row->adresse?>" name="adresse" id="adresse">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="number" class="form-control" placeholder="<?=$row->email?>" name="email" id="email">
          </div>
          <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="text" class="form-control" placeholder="( ͡° ͜ʖ ͡°)" name="mdp" id="mdp">

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
              <input type="submit" class="form-control btn btn-primary" id="submit_modif">
          </div>
        <?php } ?>
        </form>


        <a href="account.php" class="nav-link my-4 p-0" style="width:10%">Back</a>

    </div>
  </body>
</html>
