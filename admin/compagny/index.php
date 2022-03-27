<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
    <link href="../../Site_Public/Bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <?php include("../../includes/header.php"); ?>
  <body>
    <div class="w-50 col flex-wrap" id="article_reload"style="margin: auto;">
      <div class="d-flex justify-content-center">
        <a class="btn btn-success btn-lg m-4" href="addCompagny.php">Ajouter une entreprise</a>
      </div>
    </div>
    <div class="w-50 col flex-wrap" style="margin: auto;">
      <?php
      include("compagnyModel.php");

      $res = CompagnyModel::selectCompagny();

      while($row = $res->fetch(PDO::FETCH_OBJ)){ ?>
        <div class="d-flex align-items-center justify-content-between">
          <div><a href=<?php echo "compagnyShow.php?id=".$row->id_entreprise; ?> class="nav-link mx-3"><h4><?php echo $row->nom; ?></h4></a></div>
          <div>
            <form action=<?php echo "checkCompagny.php?id=".$row->id_entreprise; ?> method="post" enctype="multipart/form-data">
              <button type="submit" class="btn btn-danger btn-sm" name="delete_submit">Supprimer</button>
            </form>
          </div>
        </div>
      <?php } ?>
    </div>
  </body>
</html>
