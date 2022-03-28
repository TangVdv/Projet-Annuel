<?php

class SignModel {

  public static function HashNTrim() {
    // Trim et hash
    $trimword = trim($_POST['mot_de_passe']);
    $hashword = hash('sha256', $trimword);

    return $hashword;
  }

  public static function IfAccountAlreadyExist($email) {
    include("../includes/bdd.php");

    $req = $db->prepare('SELECT count(*) as total FROM UTILISATEUR WHERE email = :email');
    $req->execute([
      "email" => $email
    ]);
    $row = $req->fetch(PDO::FETCH_OBJ);
    if($row->total != 0){
      //header('Location:sign_up.php?message=Email déja existant&type=danger');
      return true;
    }
    return false;
  }

  public static function AddAccount() {
    include("../includes/bdd.php");



    // On récup les valeurs dans des variables
    $nom =	$_POST['nom'];
    $prenom = trim($_POST['prenom']);
    $numero = trim($_POST['numero']);
    $email = $_POST['email'];
    $password = SignModel::HashNTrim();
    $adresse = $_POST['adresse'];

    $req = $db->prepare('INSERT INTO utilisateur(admin, nom, prenom, numero, email, mot_de_passe, adresse, pts_fidelite, solde_euro)
                              VALUES(0, :nom, :prenom, :numero, :email, :mot_de_passe, :adresse, :pts_fidelite, :solde_euro)');

    $res = $req->execute([
      "nom" => $nom,
      "prenom" => $prenom,
      "numero" => $numero,
      "email" => $email,
      "mot_de_passe" => $password,
      "adresse" => $adresse,
      "pts_fidelite" => 0,
      "solde_euro" => 0.0
    ]);

    if(!$res){
      header('Location:sign_up.php?message=Erreur lors de la création du compte ; '. print_r($db->errorInfo()));
    }
    else {
      $req = $db->prepare('SELECT id_utilisateur FROM UTILISATEUR WHERE email = :email AND mot_de_passe = :password');
      $req->execute([
        "email" => $email,
        "password" => $password
      ]);
      $row = $req->fetch(PDO::FETCH_OBJ);

      SignModel::CreateSession($row->id_utilisateur);
      header('Location:../index.php?Compte créé avec succès&type=success');
    }
  }

  public static function CreateSession($id) {
    session_start();
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['id_utilisateur'] = $id;
    setcookie('email', $row->email, time() + 365*24*3600);
  }

  public static function IfUserExist() {
    include("../includes/bdd.php");
    
    /* SELECT les identifiants*/
    $req = $db->prepare('SELECT id_utilisateur, email FROM utilisateur WHERE email = :email AND mot_de_passe = :password');
    $req->execute([
      "email" => $_POST['email'],
      "password" => SignModel::HashNTrim()
    ]);

    if ($req->rowCount() == 1) {
      $row = $req->fetch(PDO::FETCH_OBJ);
      SignModel::CreateSession($row->id_utilisateur);

  		header('location:../index.php?message=Vous êtes connecté&type=success');
  		exit;
    }
    else {
      header('location:sign_in.php?message=Your account is not activated buddy.&type=danger');
      exit;
    }
  }
}

?>
