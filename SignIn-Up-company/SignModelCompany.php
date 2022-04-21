<?php

  class SignModelCompany{
    public static function HashNTrim() {
      // Trim et hash
      $trimword = trim($_POST['mot_de_passe']);
      $hashword = hash('sha256', $trimword);

      return $hashword;
    }

    public static function IfAccountAlreadyExist($email) {
      include("../includes/bdd.php");

      $req = $db->prepare('SELECT count(*) as total FROM ENTREPRISE WHERE nom = :nom');
      $req->execute([
        "nom" => $nom
      ]);
      $row = $req->fetch(PDO::FETCH_OBJ);
      if($row->total != 0){
        //header('Location:sign_up_company.php?message=Email déja existant&type=danger');
        return true;
      }
      return false;
    }

    public static function AddAccount() {
      include("../includes/bdd.php");
      include("../admin/compagny/compagnyModel.php");



      // On récup les valeurs dans des variables
      $nom =	$_POST['nom'];
      $CA = $_POST['CA'];
      $password = SignModelCompany::HashNTrim();
      //$cotisation = compagnyModel::CalculContribution($CA);

      $req = $db->prepare('INSERT INTO ENTREPRISE(nom, mot_de_passe, chiffre_affaire, statut_cotisation)
                                VALUES(:nom, :mot_de_passe, :chiffre_affaire, 0)');

      $res = $req->execute([
        "nom" => $nom,
        "mot_de_passe" => $password,
        "chiffre_affaire" => $CA
      ]);

      if(!$res){
        header('Location:sign_up_company.php?message=Erreur lors de la création du compte ; '. print_r($db->errorInfo()));
      }
      else {
        $req = $db->prepare('SELECT id_entreprise FROM ENTREPRISE WHERE nom = :nom AND mot_de_passe = :password');
        $req->execute([
          "nom" => $nom,
          "password" => $password
        ]);
        $row = $req->fetch(PDO::FETCH_OBJ);

        SignModelCompany::CreateSession($row->id_entreprise);
        header('Location:../index.php?Compte créé avec succès&type=success');
      }
    }

    public static function CreateSession($id) {
      session_start();
      $_SESSION['nom'] = $_POST['nom'];
      $_SESSION['id_entreprise'] = $id;
      setcookie('nom', $row->nom, time() + 365*24*3600);
    }

    public static function IfCompanyExist() {
      include("../includes/bdd.php");

      /* SELECT les identifiants*/
      $req = $db->prepare('SELECT id_entreprise, nom FROM ENTREPRISE WHERE nom = :nom AND mot_de_passe = :password');
      $req->execute([
        "nom" => $_POST['nom'],
        "password" => SignModelCompany::HashNTrim()
      ]);

      if ($req->rowCount() == 1) {
        $row = $req->fetch(PDO::FETCH_OBJ);
        SignModelCompany::CreateSession($row->id_utilisateur);

    		header('location:../index.php?message=Vous êtes connecté&type=success');
    		exit;
      }
      else {
        header('location:sign_in_company.php?message=Your account is not activated buddy.&type=danger');
        exit;
      }
    }
  }




 ?>
