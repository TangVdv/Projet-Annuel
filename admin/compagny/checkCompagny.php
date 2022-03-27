<?php
include("../includes/checkAdmin.php");
include('compagnyModel.php');
// UPDATE
if (isset($_POST["turnover_submit"])) {
  if(!isset($_POST["turnover"]) || empty($_POST["turnover"])){
    header("location:compagnyShow.php?Veuillez renseigner le chiffre d'affaire de l'entreprise&id=".$_GET["id"]);
    die;
  }
  if($_POST["turnover"] <= 0){
    header("location:compagnyShow.php?message=Le chiffre d'affaire doit être supérieur à 0&id=".$_GET["id"]);
    die;
  }

  CompagnyModel::UpdateContribution();

}

if (isset($_POST["status_submit"])) {
  CompagnyModel::UpdateContributionStatus();
}

// ADD
if(isset($_POST["add_submit"])){
  if(!isset($_POST["name"]) || empty($_POST["name"])){
    header("location:addCompagny.php?message=Veuillez renseigner le nom de l'entreprise");
    die;
  }
  if (CompagnyModel::IfCompagnyAlreadyExist($_POST["name"])){
    header("location:addCompagny.php?message=Cette entreprise existe déjà");
    die;
  }

  if(!isset($_POST["turnover"]) || empty($_POST["turnover"])){
    header("location:addCompagny.php?message=Veuillez renseigner le chiffre d'affaire de l'entreprise");
    die;
  }
  if($_POST["turnover"] <= 0){
    header("location:addCompagny.php?message=Le chiffre d'affaire doit être supérieur à 0");
    die;
  }

  CompagnyModel::AddCompagny();
}

// DELETE
if(isset($_POST["delete_submit"])){
    CompagnyModel::DeleteCompagny();
}

header("location:./");
?>
