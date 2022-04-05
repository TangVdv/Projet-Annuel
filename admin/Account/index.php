<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
  </head>
  <?php include("../includes/header.php"); ?>
  <body>
    <a href=".." class="nav-link ms-4" style="width:10%" translate-key="back-button"></a>
    <div class="w-50 col flex-wrap" id="article_reload"style="margin: auto;">
        <div class='table-responsive my-4'>
          <table class='table'>
            <thead class='text-center'>
              <tr>
                <th translate-key="table-lastname-title"></th>
                <th translate-key="table-firstname-title"></th>
                <th translate-key="table-email-title"></th>
                <th translate-key="table-action-title"></th>
              </tr>
            </thead>
            <?php
            include("AccountModel.php");
            $res = accountModel::SelectAccount();
            while ($row = $res->fetch(PDO::FETCH_OBJ)){?>
            <tbody class='text-center'>
              <tr>
                <td><?php echo $row->nom ?></td>
                <td><?php echo $row->prenom ?></td>
                <td><?php echo $row->email ?></td>
                <td>
                  <form action="<?php echo "checkAccount.php?id=".$row->id_utilisateur; ?>" method="post">
                    <button type="submit" class="btn btn-danger btn-sm mx-1" name="delete_submit" translate-key="delete-button"></button>
                  </form>
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
