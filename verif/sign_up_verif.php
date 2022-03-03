<?php
  $db = new PDO('mysql:host=localhost;dbname=pa', 'root', 'root' ,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  if (isset($_POST['email']) && !empty($_POST['email'])){
    setcookie('email', $_POST['email'], time()+ 365*24*3600);
  }

  if ( strlen(trim($_POST['mot_de_passe'])) < 6 || strlen(trim($_POST['prenom'])) < 4 ) {
  	header('location:../sign_up.php?message=Le mot de passe doit contenir au minimum 6 charactère&type=danger');
  }

  $trimword = trim($_POST['mot_de_passe']);
  $hashword = hash('sha256', $trimword);

  $nom =	$_POST['nom'];
  $prenom = trim($_POST['prenom']);
  $numero = trim($_POST['numero']);
  $email = $_POST['email'];
  $password = $hashword;
  $adresse = $_POST['adresse'];

  //$q = 'INSERT INTO membre (nom, email, mot_de_passe, prenom, profpic) VALUES (' . $nom . ',' . $email . ',' . $password . ',' . $prenom . ',' . $profpic . ')';

  $req = $db->query('SELECT email FROM UTILISATEUR');
  while ($row = $req->fetch(PDO::FETCH_OBJ)){
      if ($row->email === $email) {
        header('Location:../sign_up.php?Email déja existant&type=danger');
      }
  }

  $req = $db->prepare('INSERT INTO UTILISATEUR (nom, prenom, numero, email, mot_de_passe, adresse, pts_fidelite, solde_euro)
                            VALUES (:nom, :prenom, :numero, :email, :mot_de_passe, :adresse, :pts_fidelite, :solde_euro)');
  $req->execute([
    "nom" => $nom,
    "prenom" => $prenom,
    "numero" => $numero,
    "email" => $email,
    "mot_de_passe" => $password,
    "adresse" => $adresse,
    "pts_fidelite" => 0,
    "solde_euro" => 0.0
  ]);

  session_start();
  header('Location:../includes/header.php?Compte créé avec succès&type=success');

/*
  $req = $db->prepare('SELECT id_utilisateur FROM UTILISATEUR  WHERE email=:email');
  $req->execute([
    "email" => $email
  ]);

  $req = $db->query($req);
  $row = $req->fetch(PDO::FETCH_OBJ);
  $new_id = $row->id_utilisateur;

  $req = $db->prepare('INSERT INTO HISTORIQUE_ACHAT (date_achat, prix_achat, id_utilisateur) VALUES (:date_achat, :prix_achat, :id_utilisateur)');
  $req->execute([

  ]);*/

  /*if ($req){
      header('Location:../includes/header.php');
    exit;
  }*/

?>
