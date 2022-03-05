<?php
  include("../includes/bdd.php");

  $password = $_POST['mot_de_passe'];
  $email = $_POST['email'];

  // Rejète si le mdp est inférieur a 6
  if (strlen($password) < 6) {
  	header('location:sign_in.php?message=Le mot de passe doit contenir au minimum 6 charactère&type=danger');
  	exit;
  }

  // Rejète si email ou mdp vide, pas besoin techniquement
  if ( !isset($email) || empty($email) || (!isset($password) || empty($password)) ){
  	header('location:sign_in.php?message=Vous devez remplir les 2 champs.&type=danger');
  	exit;
  }

  // Trim et hash
  $trimword = trim($password);
  $hashword = hash('sha256', $trimword);

  /* SELECT les identifiants*/
  $req = $db->prepare('SELECT id_utilisateur, email FROM utilisateur WHERE email = :email AND mot_de_passe = :password');
  $req->execute([
    "email" => $email,
    "password" => $hashword
  ]);

  if ($req->rowCount() == 1) {
    $row = $req->fetch(PDO::FETCH_OBJ);
    session_start();
    setcookie('email', $row->email, time() + 365*24*3600);
		$_SESSION['email'] = $row->email;
		$_SESSION['id_utilisateur'] = $row->id_utilisateur;
		header('location:../index.php?message=Vous êtes connecté&type=success');
		exit;
  }
  else {
    header('location:sign_in.php?message=Your account is not activated buddy.&type=danger');
    exit;
  }

?>
