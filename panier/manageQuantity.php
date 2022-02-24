<?php
  function increaseQuantity($id){
    /*
    $query = $db->prepare("UPDATE ACHETE
                            SET quantite = (
                            SELECT quantite
                            FROM ACHETE
                            WHERE id_produit = :id;) +1
                          WHERE id_produit = :id;");
    $query->execute([
      "id" => $id
    ]);*/
    header('Location: panier.php');
    echo "TEST LA";
  }

  function decreaseQuantity($id){
    $query = $db->prepare("UPDATE ACHETE
                            SET quantite = (
                            SELECT quantite
                            FROM ACHETE
                            WHERE id_produit = :id;) -1
                          WHERE id_produit = :id;");
    $query->execute([
      "id" => $id
    ]);
    header('Location: panier.php');
  }


 ?>
