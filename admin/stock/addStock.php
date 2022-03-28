<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
  </head>
  <?php include("../includes/header.php"); ?>
  <body>
    <a href="index.php" class="nav-link ms-4" style="width:10%">Back</a>
    <div class="w-50" style="margin: auto;">
        <h3 class="my-4">Ajouter un entrepôt</h3>
        <form action="checkStock.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" name="name">
          </div>
          <div class="mb-3">
            <label class="form-label">Adresse</label>
            <input type="text" class="form-control" name="addr">
          </div>
          <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="number" class="form-control" name="phone">
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
    </div>
  </body>
</html>
