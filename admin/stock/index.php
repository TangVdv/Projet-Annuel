<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
  </head>
  <?php include("../includes/header.php"); ?>
  <body>
    <a href=".." class="nav-link ms-4" style="width:10%" translate-key="back-button"></a>
    <div class="w-50 col flex-wrap" style="margin: auto;">
      <div class="d-flex justify-content-center">
        <a class="btn btn-success btn-lg m-4" href="addStock.php" translate-key="addwarehouse-title"></a>
      </div>
    </div>
    <div class="w-50 col flex-wrap" style="margin: auto;">
        <div class='table-responsive my-4'>
          <table class='table'>
            <thead class='text-center'>
              <tr>
                <th translate-key="name-title"></th>
                <th translate-key="address-title"></th>
                <th translate-key="phone-title"></th>
                <th translate-key="stock-title"></th>
              </tr>
            </thead>
            <?php
            include("stockModel.php");
            $res = stockModel::SelectStock();
            while ($row = $res->fetch(PDO::FETCH_OBJ)){?>
            <tbody class='text-center'>
              <tr>
                <td><?php echo $row->nom ?></td>
                <td><?php echo $row->adresse ?></td>
                <td><?php echo $row->telephone ?></td>
                <td>
                  <div class="d-flex justify-content-center">
                    <a class="btn btn-success btn-sm mx-1" href=<?php echo "stockShow.php?id=".$row->id_entrepot; ?> translate-key="product-title"></a>
                    <form action=<?php echo "checkStock.php?id=".$row->id_entrepot; ?> method="post">
                      <button type="submit" class="btn btn-danger btn-sm mx-1" name="delete_stock_submit" translate-key="delete-button"></button>
                    </form>
                  </div>
                </td>
              </tr>
            </tbody>
          <?php } ?>
          </table>
        </div>
        </tbody>
       </table>
     </div>

    </div>
  </body>
</html>
