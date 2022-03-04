<?php
  $db = new PDO('mysql:host=localhost;dbname=pa', 'root', 'root' ,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  // Set un cookie si l'utilisateur est connecté
  if (isset($_POST['email']) && !empty($_POST['email'])){
    setcookie('email', $_POST['email'], time() + 365*24*3600);
    header('location:../includes/header.php?message=Vous êtes connecté&type=success');
  }

  // Rejète si le mdp est inférieur a 6
  if (strlen($_POST['mot_de_passe']) < 6) {
  	header('location:../sign_in.php?message=Le mot de passe doit contenir au minimum 6 charactère&type=danger');
  	exit;
  }

  // Rejète si email ou mdp vide, pas besoin techniquement
  if ( !isset($_POST['email']) || empty($_POST['email']) || (!isset($_POST['mot_de_passe']) || empty($_POST['mot_de_passe'])) ){
  	header('location:../sign_in.php?message=Vous devez remplir les 2 champs.&type=danger');
  	exit;
  }

  /* Faut pas utiliser de SELECt *, je sais*/
  $req = $db->prepare('SELECT email, mot_de_passe FROM utilisateur WHERE id_utilisateur = :id_utilisateur');
  $req->execute([
    "id_utilisateur" => "1"
  ]);

  $trimword = trim($_POST['mot_de_passe']);
  $hashword = hash('sha256', $trimword);

  foreach ($req as $row) {

	if ( ( $_POST['email'] != $row['email'] ) || ( $hashword != $row['mot_de_passe'] ) ){
		header('location:../sign_in.php?message=Email ou mot de passe invalide.&type=danger');
	}

	else if ($row['active'] == '0') {
		header('location:../sign_in.php?message=Your account is not activated buddy.&type=danger');
	}

	else {
		session_start();
		$_SESSION['email'] = $_POST['email'];
		//$_SESSION['id_utilisateur'] = $row['id_utilisateur'];
		//$_SESSION['username'] = $row['username'];
		header('location:../includes/header.php?message=Vous êtes connecté&type=success');
		exit;
	}

}
?>
