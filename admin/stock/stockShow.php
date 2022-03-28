<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
  </head>
  <?php include("../includes/header.php"); ?>
  <body>
    <a href="index.php" class="nav-link ms-4" style="width:10%">Back</a>
    <?php
    include("stockModel.php");
    $res = stockModel::selectSpecificStock();
    $row = $res->fetch(PDO::FETCH_OBJ);
     ?>
    <div class="d-flex m-4 justify-content-between">
      <h2><?php echo "Entrepôt : ".$row->nom ?></h2>
      <button class="btn btn-success btn-lg" data-bs-toggle="offcanvas" data-bs-target="#addProductCanvas">Ajouter un Produit</button>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="addProductCanvas">
      <div class="offcanvas-header">
        <h5>Choisissez un produit à ajouter</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="d-flext row text-center">

          <?php
          include("../product/productModel.php");
          $res = productModel::SelectProduct(false);
          while ($row = $res->fetch(PDO::FETCH_OBJ)) {
          ?>
          <div class="btn" onclick="document.location.href='checkStock.php?idP=<?php echo $row->id_produit; ?>&idE=<?php echo $_GET["id"]; ?>'">
            <div class="card mb-4 shadow-sm">
              <img src=<?php echo "/img/products/".$row->image; ?> >
              <div class="card-body p-0">
                <div class="card-text">
                  <p><?php echo $row->nom; ?></p>
                </div>
                <div class="card-footer text-muted p-1">
                  <p class="m-0"><?php echo $row->prix." €"; ?></p>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
    <hr>
    <h4 class="m-4">Tous les produits se trouvant dans l'entrepôt : </h4>
    <div class="d-flex flex-wrap border border-1 rounded m-4">
      <div class="mx-4">
            <?php
            $res = stockModel::selectProductAsStock();
            while ($row = $res->fetch(PDO::FETCH_OBJ)) {
            ?>
            <div id=<?php echo $row->id_produit; ?> class='text-center btn' data-bs-toggle="modal" data-bs-target=<?php echo "#modal-".$row->id_produit?>>
              <div class='card mb-4 shadow-sm'>
                <img src=<?php echo "/img/products/".$row->image; ?> width='200px' height='200px'>
                <div class='card-body p-0'>
                  <div class='card-text'>
                    <p class='m-0' style='width: 200px; word-wrap: break-word;'><?php echo $row->nom; ?></p>
                  </div>
                  <div class='card-footer text-muted p-1'>
                    <p class='m-0'><?php echo $row->prix." €"; ?></p>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id=<?php echo "modal-".$row->id_produit ;?> data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Information du produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center">
                    <table class='table table-striped'>
                      <thead class='text-center'>
                        <tr>
                          <th>image</th>
                          <th>nom</th>
                          <th>description</th>
                          <th>prix</th>
                          <th>reduction</th>
                          <th>stock</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><img src=<?php echo "/img/products/".$row->image; ?> width="50px" height="50px"></td>
                          <td><?php echo $row->nom; ?></td>
                          <td><?php echo $row->description; ?></td>
                          <td><?php echo $row->prix; ?></td>
                          <td><?php echo $row->reduction; ?></td>
                          <td><?php echo $row->stock; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <div>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Annuler</button>
                    </div>
                    <div>
                      <form action=<?php echo "checkStock.php?idP=".$row->id_produit."&idE=".$_GET["id"]; ?> method="post">
                        <button type="submit" class="btn btn-danger btn-sm mx-1" name="delete_product_submit">Supprimer</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
      </div>
    </div>
  </body>
</html>
