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

    $req = $db->prepare("SELECT nom, prenom, numero, email, adresse
                        FROM utilisateur
                        WHERE id_utilisateur = :id_utilisateur");
    $req->execute([
      "id_utilisateur" => $_SESSION['id_utilisateur']
    ]);

    return $req;
  }

  public static function UpdateAccountInfos() {
    includes("../includes/bdd.php");

    // On récup les valeurs dans des variables
    $nom =	$_POST['nom'];
    $prenom = trim($_POST['prenom']);
    $numero = trim($_POST['numero']);
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    //$password = SignModel::HashNTrim();


    $req = $db->prepare("UPDATE utilisateur SET
      nom = $nom, prenom = $prenom, numero = $numero, adresse = $adresse, email = $email
      WHERE nom = :nom, prenom = :prenom, numero = :numero, adresse = :adresse, email = :email");

      
  }

}



?>
