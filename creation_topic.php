<?php
session_start();
include("includes/identifiant.php");

$nom_topic = $_POST['nom_topic'];
$statut = $_POST['statut'];

$db->query("INSERT INTO topics(topic, statut) VALUES ('$nom_topic', '$statut')");

$_SESSION["message"] = 'Le topic a été créé.';
header("Location:moderation.php");

?>
