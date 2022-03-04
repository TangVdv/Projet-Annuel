<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
    <script src="../../lib/bootstrap.min.js" charset="utf-8"></script>
  </head>
  <?php include("../../includes/header.php"); ?>
  <body>
    <?php
    include("compagnyModel.php");
    $res = compagnyModel::selectSpecificCompagny();
    $row = $res->fetch(PDO::FETCH_OBJ);
     ?>
    <div class="text-center m-4">
      <h2><?php echo $row->nom ?></h2>
    </div>
    <hr>
    <h4 class="m-4">Tous les produits dont dispose l'entreprise : </h4>
    <div class="d-flex flex-wrap border border-1 rounded m-4">
      <div class="mx-4">
            <?php
            $res = compagnyModel::selectProductAsCompagny();
            while ($row = $res->fetch(PDO::FETCH_OBJ)) {
            ?>
            <div id=<?php echo $row->id_produit; ?> class='text-center btn' data-bs-toggle="modal" data-bs-target=<?php echo "#modal-".$row->id_produit?>>
              <div class='card mb-4 shadow-sm'>
                <img src=<?php echo "../../img/products/".$row->image; ?> width='200px' height='200px'>
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
                </div>
              </div>
            </div>
            <?php } ?>
      </div>
    </div>
  </body>
</html>
