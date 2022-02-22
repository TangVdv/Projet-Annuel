<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
  </head>
  <?php include("../../includes/header.php"); ?>
  <body>
    <div class="w-50" style="margin: auto;">
        <h3 class="my-4">Ajouter un produit </h3>
        <form class="" action="check_add_product.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" name="name" id="name">
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" id="description" rows="3" name="description"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Prix</label>
            <input type="number" step=".01" class="form-control" name="price" id="price">
          </div>
          <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" class="form-control" name="stock" id="stock">
          </div>
          <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" id="image" name="img" accept="image/png, image/jpeg">
          </div>
          <div class="mb-3 w-25">
              <input type="submit" class="form-control btn btn-primary" id="submit_modif">
          </div>
        </form>


        <a href="index.php" class="nav-link my-4 p-0" style="width:10%">Back</a>

    </div>
  </body>
</html>
