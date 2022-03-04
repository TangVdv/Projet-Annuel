<?php
  include("../includes/bdd.php");

  // Rejète si le mdp est inférieur a 6
  if (strlen($_POST['mot_de_passe']) < 6) {
  	header('location:sign_in.php?message=Le mot de passe doit contenir au minimum 6 charactère&type=danger');
  	exit;
  }

  // Rejète si email ou mdp vide, pas besoin techniquement
  if ( !isset($_POST['email']) || empty($_POST['email']) || (!isset($_POST['mot_de_passe']) || empty($_POST['mot_de_passe'])) ){
  	header('location:sign_in.php?message=Vous devez remplir les 2 champs.&type=danger');
  	exit;
  }

  /* SELECT les identifiants*/
  $req = $db->prepare('SELECT email, mot_de_passe FROM utilisateur');
  $req->execute();

  // Trim et hash
  $trimword = trim($_POST['mot_de_passe']);
  $hashword = hash('sha256', $trimword);

  // Boucle pour comparer l'input à ce qu'il y a dans la bdd
  foreach ($req as $row) {
    // Dans le cas ou ça marche pas
	if ( ( $_POST['email'] != $row['email'] ) || ( $hashword != $row['mot_de_passe'] ) ){
		header('location:sign_in.php?message=Email ou mot de passe invalide.&type=danger');
    exit;
	}

	/*else if ($row['active'] == '0') {
		header('location:../sign_in.php?message=Your account is not activated buddy.&type=danger');
	}*/
  // Dans le cas ou ça marche
	else {
		session_start();
    setcookie('email', $_POST['email'], time() + 365*24*3600);
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['id_utilisateur'] = $row['id_utilisateur'];
		header('location:../index.php?message=Vous êtes connecté&type=success');
		exit;
	}

}
?>
