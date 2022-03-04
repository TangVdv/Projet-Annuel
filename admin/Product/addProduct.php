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
        <form class="" action="checkAddProduct.php" method="post" enctype="multipart/form-data">
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
            <label class="form-label">Entreprise</label>
            <select class="form-select" name="compagny" id="compagny">
              <option value="">Choisir une entreprise</option>
              <?php
              include("../compagny/compagnyModel.php");

              $res = compagnyModel::selectCompagny();
              while($row = $res->fetch(PDO::FETCH_OBJ)){
                echo "<option value=".$row->id_entreprise.">".$row->nom."</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" id="image" name="img" accept="image/png, image/jpeg">
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
        </form>


        <a href="index.php" class="nav-link my-4 p-0" style="width:10%">Back</a>

    </div>
  </body>
</html>
