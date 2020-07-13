<?php
//Cette fonction doit être appelée avant tout code html
session_start();

//On donne ensuite un titre à la page, puis on appelle notre fichier debut.php
$titre = "Index du forum";
include("includes/identifiant.php");
include("includes/header.php");
?>

<h1>Mon super forum</h1>

<?php
//Initialisation de deux variables
$totaldesmessages = 0;
$categorie = NULL;
?>


<?php include("includes/footer.php") ?>
