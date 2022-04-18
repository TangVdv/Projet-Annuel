<?php

class AccountPageModel {

  public static function DisplayLastOrder() {
    include("../includes/bdd.php");

    $req = $db->prepare("SELECT image, nom, prix_achat, date_achat, quantite
                        FROM HISTORIQUE_ACHAT
                        INNER JOIN PRODUIT ON produit.id_produit = historique_achat.id_produit
                        WHERE historique_achat.id_utilisateur = :id_utilisateur
                        ORDER BY date_achat DESC LIMIT 1; --Jsp si ça prend aussi en compte ceux des autres users");

    $req->execute([
      "id_utilisateur" => $_SESSION['id_utilisateur']
    ]);

    return $req;
  }

  public static function DisplayName() {
    include("../includes/bdd.php");

    $req = $db->prepare('SELECT nom FROM utilisateur
                        WHERE id_utilisateur = :id_utilisateur');
           $req->execute([
            "id_utilisateur" => $_SESSION['id_utilisateur']
           ]);

    return $req;
  }

  public static function DisplayOrders() {
    include("../includes/bdd.php");

    $req = $db->prepare("SELECT image, nom, prix_achat, date_achat, quantite
                        FROM HISTORIQUE_ACHAT
                        INNER JOIN PRODUIT ON produit.id_produit = historique_achat.id_produit
                        WHERE historique_achat.id_utilisateur = :id_utilisateur
                        ORDER BY date_achat DESC; --Jsp si ça prend aussi en compte ceux des autres users");

    $req->execute([
      "id_utilisateur" => $_SESSION['id_utilisateur']
    ]);

    return $req;
  }

  public static function DisplayAccountInfos() {
    include("../includes/bdd.php");

    $req = $db->prepare("SELECT hash_id, nom, prenom, numero, email, adresse
                        FROM utilisateur
                        WHERE id_utilisateur = :id_utilisateur");
    $req->execute([
      "id_utilisateur" => $_SESSION['id_utilisateur']
    ]);

    return $req;
  }

  public static function UpdateAccountInfos($nom, $prenom, $numero, $adresse, $email, $password) {
    include("../includes/bdd.php");

    $req = $db->prepare("UPDATE utilisateur SET
      nom = :nom, prenom = :prenom, numero = :numero, adresse = :adresse, email = :email, mot_de_passe = :password
      WHERE id_utilisateur = :id_utilisateur");

      $res = $req->execute([
        "id_utilisateur" => $_SESSION['id_utilisateur'],
        "nom" => $nom,
        "prenom" => $prenom,
        "numero" => $numero,
        "adresse" => $adresse,
        "email" => $email,
        "password" => $password
      ]);
  }

  public static function qrCode() {
      $res = AccountPageModel::DisplayAccountInfos();
      $row = $res->fetch(PDO::FETCH_OBJ);

      $url = "https://api.qrserver.com/v1/create-qr-code/";
      $strPost = "data=". $row->hash_id ."&size=120x120&bgcolor=004579";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $strPost);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      $img = curl_exec($ch);
      if(curl_error($ch)) {
          echo curl_error($ch);
      }

      curl_close($ch);

      if($img) {
        $filename = "../img/qrcode/qrcode-".$row->hash_id.".png";
        if(!preg_match("#\.png$#i", $filename)) {
            $filename .= ".png";
        }
        return file_put_contents($filename, $img);
      }
      return false;
    }
}

?>
