<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
    <script src="../../lib/bootstrap.min.js" charset="utf-8"></script>
  </head>
  <?php include("../../includes/header.php"); ?>
  <body>

    <div class="w-50 col flex-wrap" id="article_reload"style="margin: auto;">
      <div class="d-flex justify-content-center">
        <a class="btn btn-success btn-lg m-4" href="addProduct.php">Ajouter un Produit</a>
      </div>
    </div>
    <div class="d-flex flex-wrap">
      <div class="mx-4">
            <?php
            include("productModel.php");
            $res = productModel::SelectProduct();
            while ($row = $res->fetch(PDO::FETCH_OBJ)) {
            ?>
            <div id=<?php echo $row->id_produit; ?> class="text-center btn" data-bs-toggle="modal" data-bs-target=<?php echo "#modal-".$row->id_produit?>>
              <div class="card mb-4 shadow-sm">
                <img src=<?php echo "../../img/products/".$row->image; ?> width="200px" height="200px">
                <div class="card-body p-0">
                  <div style="width: 200px;" class="card-text">
                    <p><?php echo $row->nom; ?></p>
                  </div>
                  <div class="card-footer text-muted p-1">
                    <p class="m-0"><?php echo $row->prix." €"; ?></p>
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
                          <td><img src=<?php echo "../../img/products/".$row->image; ?> width="50px" height="50px"></td>
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
                      <a class="btn btn-danger" href=<?php echo "checkDeleteProduct.php?id=".$row->id_produit; ?>>Supprimer</a>
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