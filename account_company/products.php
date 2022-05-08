<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Company site</title>
  </head>
  <?php include("../includes/header.php");
  include("verifCompanyLogin.php");
  require_once("productModelCompany.php");
  $req = productModelCompany::checkPaymentStatus();
  while ($row = $req->fetch(PDO::FETCH_OBJ)){
    $status = $row->statut_cotisation;
    if($status != 0 && $status != 1){
      header("location:account.php?message=Vous n'avez plus accès à ce service");
    }
  }
  ?>
  <body>
    <div class="w-50 col flex-wrap" id="article_reload"style="margin: auto;">
      <div class="d-flex justify-content-center">
        <a class="btn btn-success btn-lg m-4" href="addProductCompany.php" translate-key="addproduct-title"></a>
      </div>
    </div>
    <div class="d-flex flex-wrap row border m-4">
      <h4 class="border-bottom text-primary p-2" translate-key="service-title"></h4>
      <div class="mx-4">
            <?php
            require_once("productModelCompany.php");
            $res = productModelCompany::SelectService();
            while ($row = $res->fetch(PDO::FETCH_OBJ)) {
            ?>
            <div id=<?php echo $row->id_produit; ?> class="text-center btn" data-bs-toggle="modal" data-bs-target=<?php echo "#modal-".$row->id_produit?>>
              <div class="card mb-4 shadow-sm">
                <img src=<?php echo "/img/products/".$row->image; ?> width="200px" height="200px">
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
                    <h5 class="modal-title" id="exampleModalCenteredScrollableTitle" translate-key="informationproduct-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center">
                    <table class='table table-striped'>
                      <thead class='text-center'>
                        <tr>
                          <th translate-key="image-title"></th>
                          <th translate-key="name-title"></th>
                          <th translate-key="desc-title"></th>
                          <th translate-key="price-title"></th>
                          <th translate-key="discount-title"></th>
                          <th translate-key="stock-title"></th>
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
                      <button type="button" class="btn btn-secondary" id="cancel_submit" data-bs-dismiss="modal" aria-label="Close" translate-key="cancel-button"></button>
                    </div>
                    <div class="d-flex">
                      <div class="mx-4">
                        <button type="button" class="btn btn-primary" id="modify_submit" name=<?php echo $row->id_produit; ?> translate-key="modify-button"></button>
                      </div>
                      <div>
                        <form action=<?php echo "checkProductCompany.php?id=".$row->id_produit; ?> method="post">
                          <button type="submit" class="btn btn-danger" name="delete_submit" translate-key="delete-button"></button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <?php } ?>
      </div>
    </div>
    <div class="d-flex flex-wrap row border m-4">
      <h4 class="border-bottom text-success p-2" translate-key="warehouseproduct-title"></h4>
      <div class="mx-4">
            <?php
            $res = productModelCompany::SelectProduct(true);
            while ($row = $res->fetch(PDO::FETCH_OBJ)) {
            ?>
            <div id=<?php echo $row->id_produit; ?> class="text-center btn" data-bs-toggle="modal" data-bs-target=<?php echo "#modal-".$row->id_produit?>>
              <div class="card mb-4 shadow-sm">
                <img src=<?php echo "/img/products/".$row->image; ?> width="200px" height="200px">
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
                    <h5 class="modal-title" id="exampleModalCenteredScrollableTitle" translate-key="informationproduct-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center">
                    <table class='table table-striped'>
                      <thead class='text-center'>
                        <tr>
                          <th translate-key="image-title"></th>
                          <th translate-key="name-title"></th>
                          <th translate-key="desc-title"></th>
                          <th translate-key="price-title"></th>
                          <th translate-key="discount-title"></th>
                          <th translate-key="stock-title"></th>
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
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" translate-key="cancel-button"></button>
                    </div>
                    <div class="d-flex">
                      <div class="mx-4">
                        <button type="button" class="btn btn-primary" id="modify_submit" name=<?php echo $row->id_produit; ?> translate-key="modify-button"></button>
                      </div>
                      <div>
                        <form action=<?php echo "checkProductCompany.php?id=".$row->id_produit; ?> method="post">
                          <button type="submit" class="btn btn-danger" name="delete_submit" translate-key="delete-button"></button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php } ?>
      </div>
    </div>
    <br>
    <div class="d-flex flex-wrap row border m-4">
      <h4 class="border-bottom text-danger p-2" translate-key="notwarehouseproduct-title"></h4>
      <div class="mx-4">
            <?php
            $res = productModelCompany::SelectProduct(false);
            while ($row = $res->fetch(PDO::FETCH_OBJ)) {
            ?>
            <div id=<?php echo $row->id_produit; ?> class="text-center btn" data-bs-toggle="modal" data-bs-target=<?php echo "#modal-".$row->id_produit?>>
              <div class="card mb-4 shadow-sm">
                <img src=<?php echo "/img/products/".$row->image; ?> width="200px" height="200px">
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
                    <h5 class="modal-title" id="exampleModalCenteredScrollableTitle" translate-key="informationproduct-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center">
                    <table class='table table-striped'>
                      <thead class='text-center'>
                        <tr>
                          <th translate-key="image-title"></th>
                          <th translate-key="name-title"></th>
                          <th translate-key="desc-title"></th>
                          <th translate-key="price-title"></th>
                          <th translate-key="discount-title"></th>
                          <th translate-key="stock-title"></th>
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
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" translate-key="cancel-button"></button>
                    </div>
                    <div class="d-flex">
                      <div class="mx-4">
                        <button type="button" class="btn btn-primary" id="modify_submit" name=<?php echo $row->id_produit; ?> translate-key="modify-button"></button>
                      </div>
                      <div>
                        <form action=<?php echo "checkProductCompany.php?id=".$row->id_produit; ?> method="post">
                          <button type="submit" class="btn btn-danger" name="delete_submit" translate-key="delete-button"></button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php } ?>
      </div>
    </div>
    <script src="/admin/lib/modifyProduct.js" charset="utf-8"></script>
  </body>
</html>
