

<?php

//Attribution des variables de session

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['login']))?$_SESSION['login']:'';

//On inclut les 2 pages restantes
include("functions.php");
?>
