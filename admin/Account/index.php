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
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Action</th>
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
                  <a class="btn btn-danger btn-sm mx-1" href=<?php echo "checkAccount.php?id=".$row->id_utilisateur; ?>>Supprimer</a>
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
