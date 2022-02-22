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
                <th>Actions</th>
              </tr>
            </thead>
            <?php
            include("../../includes/bdd.php");
            $db = OpenDb();
            $res = SelectAll("utilisateur", $db);
            while ($row = $res->fetch(PDO::FETCH_OBJ)){?>
            <tbody class='text-center'>
              <tr>
                <td><?php echo $row->nom ?></td>
                <td><?php echo $row->prenom ?></td>
                <td><?php echo $row->email ?></td>
                <td>
                  <button type='button' class='btn btn-primary btn-sm mx-1'>Editer</button>
                  <button type='button' class='btn btn-danger btn-sm mx-1'>Supprimer</button>

                  <div class='modal fade' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
										<div class='modal-dialog'>
											<div class='modal-content bg-dark'>
												<div class='modal-header'>
													<h5 class='modal-title text-light'>Suppression d'un utilisateur</h5>
													<button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal' aria-label='Close'></button>
												</div>
												<div class='modal-body text-light'>
													Voulez vous vraiment supprimer cet utilisateur ?
												</div>
												<div class='modal-footer'>
													<button type='button' class='btn btn-danger'  data-bs-dismiss='modal'>OUI</button>
													<button type='button' class='btn btn-primary' data-bs-dismiss='modal' aria-label='Close'>NON</button>
												</div>
											</div>
										</div>
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

    <script src="../admin.js" charset="utf-8"></script>
    <script src="../bootstrap.bundle.min.js" charset="utf-8"></script>
  </body>
</html>
