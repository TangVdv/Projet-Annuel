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

  $nom =	'"' . $_POST['nom'] . '"';
  $prenom = '"' . trim($_POST['prenom']) . '"';
  $numero = '"' . trim($_POST['numero']) . '"';
  $email = '"' . $_POST['email'] . '"';
  $password = '"' . $hashword . '"';
  $adresse = '"' . $_POST['adresse'] . '"';

  //$q = 'INSERT INTO membre (nom, email, mot_de_passe, prenom, profpic) VALUES (' . $nom . ',' . $email . ',' . $password . ',' . $prenom . ',' . $profpic . ')';

  $reponse = $db->query('SELECT email FROM UTILISATEUR');
  while ($row = $reponse->fetch(PDO::FETCH_OBJ)){
      if ($row->email === $email) {
        header('Location:../sign_up.php?Email déja existant&type=danger');
      }
  }

  /*$reponse = $db->prepare('INSERT INTO HISTORIQUE VALUES :date_achat');
  $reponse->execute([

  ]);*/

  $reponse = $db->prepare('INSERT INTO UTILISATEUR VALUES :nom, :prenom, :numero, :email, :mot_de_passe, :adresse, :pts_fidelite, :solde_euro');
  $reponse->execute([
    "nom" => $nom,
    "prenom" => $prenom,
    "numero" => $numero,
    "email" => $email,
    "mot_de_passe" => $password,
    "adresse" => $adresse,
    "pts_fidelite" => 0,
    "solde_euro" => 0
  ]);

  /*if ($reponse){
      header('Location:../includes/header.php');
    exit;
  }*/

?>
