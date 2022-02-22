<?php
include("../includes/bdd.php");

$column = array("id_produit", "id_panier");
$value = array($_GET["id"], 4 /*TODO: Mettre l'id du panier de l'utilisateur*/ );

$db = OpenDb();
InsertValues("Ajoute", $column, $value, $db);

header("location:./index.php");
?>
