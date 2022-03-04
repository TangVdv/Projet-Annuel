<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
  </head>
  <?php include("../../includes/header.php"); ?>
  <body>
    <div class="w-50 col flex-wrap" id="article_reload"style="margin: auto;">
        <div class='table-responsive my-4'>
          <table class='table'>
            <thead class='text-center'>
              <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Stock</th>
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
                  <a class="btn btn-success btn-sm mx-1" href=<?php echo "stockShow.php?id=".$row->id_entrepot; ?>>Produit</a>
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
