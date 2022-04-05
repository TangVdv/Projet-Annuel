<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
  </head>
  <?php include("../includes/header.php"); ?>
  <body>
    <a href="index.php" class="nav-link ms-4" style="width:10%" translate-key="back-button"></a>
    <div class="w-50" style="margin: auto;">
        <h3 class="my-4" translate-key="addproduct-title"></h3>
        <form class="" action="checkProduct.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label" translate-key="name-title"></label>
            <input type="text" class="form-control" name="name">
          </div>
          <div class="mb-3">
            <label class="form-label" translate-key="desc-title"></label>
            <textarea class="form-control" rows="3" name="description"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label" translate-key="price-title"></label>
            <input type="number" step=".01" class="form-control" name="price">
          </div>
          <div class="mb-3">
            <label class="form-label" translate-key="stock-title"></label>
            <input type="number" class="form-control" name="stock">
          </div>
          <div class="mb-3">
            <label class="form-label" translate-key="compagny-title"></label>
            <select class="form-select" name="compagny" id="compagny">
              <option value="" translate-key"compagny-desc"></option>
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
            <label class="form-label" translate-key="image-title"></label>
            <button class="btn btn-outline-secondary" type="button" style="display:block;" onclick="document.getElementById('getFile').click()" translate-key="image-desc"></button>
            <input type="file" id="getFile" name="img" accept="image/png, image/jpeg" style="display:none">
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
              <button type="submit" class="form-control btn btn-primary" name="add_submit" translate-key="submit-button"></button>
          </div>
        </form>
    </div>
  </body>
</html>
