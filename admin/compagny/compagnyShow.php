<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin site</title>
  </head>
  <?php include("../includes/header.php"); ?>
  <body>
    <a href="index.php" class="nav-link ms-4" style="width:10%" translate-key="back-button"></a>
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
            echo "<p class='text-success' translate-key='contributioncompagny-title'></p>";
          }
          else{
            echo "<p class='text-danger' translate-key='notcontributioncompagny-title'></p>";
          }
         ?>
       </div>
       <div class="ms-4">
         <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#contribution_status">Changer</button>

         <div class="modal fade" id="contribution_status" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
           <div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" translate-key="contributionquestion-title"></h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                 <form action=<?php echo "checkCompagny.php?id=".$_GET["id"]; ?> method="post" enctype="multipart/form-data">
                   <div class="form-check m-4">
                    <input class="form-check-input" type="radio" name="status" value="1">
                    <label class="form-check-label" translate-key="yes-title"></label>
                  </div>
                  <div class="form-check m-4">
                    <input class="form-check-input" type="radio" name="status" value="0" checked>
                    <label class="form-check-label" translate-key="no-title"></label>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" translate-key="cancel-button"></button>
                    <button type="submit" class="btn btn-primary" name="status_submit" translate-key="validate-button"></button>
                  </div>
                 </form>
               </div>
             </div>
           </div>
         </div>

       </div>
   </div>
     <div class="d-flex align-self-center">
       <div class="ms-4 d-flex"><p translate-key="contributionamount-title"></p><p class="mx-2"><?php echo $row->cotisation ?></p></div>
       <div class="ms-4">
         <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#contribution" translate-key="change-button"></button>

         <div class="modal fade" id="contribution" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
           <div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" translate-key="setnewturnover-title"></h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body text-center">
                 <form action=<?php echo "checkCompagny.php?id=".$_GET["id"]; ?> method="post" enctype="multipart/form-data">
                   <div class="mb-3">
                     <input type="number" class="form-control" name="turnover" id="turnover">
                   </div>
                   <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" translate-key="cancel-button"></button>
                     <button type="submit" class="btn btn-primary" name="turnover_submit" translate-key="validate-button"></button>
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
    <h4 class="m-4" translate-key="productcompagny-title"></h4>
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
