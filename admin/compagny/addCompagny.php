<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
  </head>
  <?php include("../../includes/header.php"); ?>
  <body>
    <div class="w-50" style="margin: auto;">
        <h3 class="my-4">Ajouter une entreprise </h3>
        <form action="checkCompagny.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" name="name">
          </div>
          <div class="mb-3">
            <label class="form-label">Chiffre d'affaire</label>
            <input type="number" class="form-control" name="turnover">
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
              <input type="submit" class="form-control btn btn-primary" name="add_submit">
          </div>
        </form>


        <a href="index.php" class="nav-link my-4 p-0" style="width:10%">Back</a>

    </div>
  </body>
</html>
