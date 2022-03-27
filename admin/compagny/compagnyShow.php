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
    $res = CompagnyModel::selectSpecificCompagny();
    $row = $res->fetch(PDO::FETCH_OBJ);
     ?>
    <div class="text-center m-4">
      <h2><?php echo $row->nom ?></h2>
    </div>
    <div class="d-flex align-self-center">
      <div class="ms-4">
        <?php
          if($row->statut_cotisation == 1){
            echo "<p class='text-success'> Cette entreprise a payée sa cotisation. </p>";
          }
          else{
            echo "<p class='text-danger'> Cette entreprise n'a pas encore payée sa cotisation. </p>";
          }
         ?>
       </div>
       <div class="ms-4">
         <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#contribution_status">Changer</button>

         <div class="modal fade" id="contribution_status" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
           <div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title">L'entreprise a-t-elle payée la cotisation ?</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                 <form action=<?php echo "checkCompagny.php?id=".$_GET["id"]; ?> method="post" enctype="multipart/form-data">
                   <div class="form-check m-4">
                    <input class="form-check-input" type="radio" name="status" value="1">
                    <label class="form-check-label">
                      Oui
                    </label>
                  </div>
                  <div class="form-check m-4">
                    <input class="form-check-input" type="radio" name="status" value="0" checked>
                    <label class="form-check-label">
                      Non
                    </label>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" name="status_submit">Valider</button>
                  </div>
                 </form>
               </div>
             </div>
           </div>
         </div>

       </div>
   </div>
     <div class="d-flex align-self-center">
       <div class="ms-4"><p>Montant de la cotisation : <?php echo $row->cotisation ?></p></div>
       <div class="ms-4">
         <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#contribution">Changer</button>

         <div class="modal fade" id="contribution" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
           <div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title">Renseignez le nouveau chiffre d'affaire de l'entreprise</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body text-center">
                 <form action=<?php echo "checkCompagny.php?id=".$_GET["id"]; ?> method="post" enctype="multipart/form-data">
                   <div class="mb-3">
                     <input type="number" class="form-control" name="turnover" id="turnover">
                   </div>
                   <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                     <button type="submit" class="btn btn-primary" name="turnover_submit">Valider</button>
                   </div>
                 </form>
               </div>
             </div>
           </div>
         </div>
       </div>
       <p class="text-danger ms-4">
       <?php
         if(isset($_GET["message"]) || !empty($_GET["message"])){
             echo "Erreur : ".$_GET["message"];
         }
       ?>
       </p>
    </div>
    <hr>
    <h4 class="m-4">Tous les produits dont dispose l'entreprise : </h4>
    <div class="d-flex flex-wrap border border-1 rounded m-4">
      <div class="mx-4">
            <?php
            $res = CompagnyModel::selectProductAsCompagny();
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
            <?php } ?>
      </div>
    </div>
  </body>
</html>
