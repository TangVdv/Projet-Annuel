<?php
require_once 'dompdf/autoload.inc.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;

class AccountPageModel {

  public static function DisplayLastOrder() {
    include("../includes/bdd.php");

    $req = $db->prepare("SELECT historique_achat.id_historique, produit.id_produit, image, nom, prix_achat, date_achat, quantite
                        FROM HISTORIQUE_ACHAT
                        INNER JOIN PRODUIT ON produit.id_produit = historique_achat.id_produit
                        WHERE historique_achat.id_utilisateur = :id_utilisateur
                        ORDER BY date_achat DESC LIMIT 1");

    $req->execute([
      "id_utilisateur" => $_SESSION['id_utilisateur']
    ]);

    return $req;
  }

  public static function DisplayName() {
    include("../includes/bdd.php");

    $req = $db->prepare('SELECT nom, solde_euro FROM utilisateur
                        WHERE id_utilisateur = :id_utilisateur');
           $req->execute([
            "id_utilisateur" => $_SESSION['id_utilisateur']
           ]);

    return $req;
  }

  public static function DisplayOrders() {
    include("../includes/bdd.php");

    $req = $db->prepare("SELECT historique_achat.id_historique, produit.id_produit, image, nom, prix_achat, date_achat, quantite
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

  public static function pdf(){
    $res = AccountPageModel::DisplayAccountInfos();
    $row = $res->fetch(PDO::FETCH_OBJ);

    $content = '
    <div>
       <p>'.$row->prenom.' '.$row->nom.'</p>
       <p>'.$row->adresse.'</p>
       <p>'.$row->email.'</p>
       <p>'.$row->numero.'</p>
    </div>
    <div>
      <img src="https://upload.wikimedia.org/wikipedia/commons/d/d7/Android_robot.svg" height="200" width="200">
      <img src="../img/qrcode/qrcode-'.$row->hash_id.'.png" height="120", width="120">
    </div>

    ';

    // instantiate and use the dompdf class
    $dompdf = new Dompdf(["isRemoteEnabled" => true]);
    $dompdf->loadHtml($content);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
  }
}

?>
