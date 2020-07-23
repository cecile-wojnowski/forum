<?php
session_start();
include("includes/identifiant.php"); # Connecte à la base

# Cette page va servir à like
$like_dislike = true;

# S'il n'y a pas de $_POST["like"], on redirige vers la liste des topics
# Sinon, on prend la variable dont on a besoin et on continu
if(!isset($_POST["like"])) {
  header("Location:topics.php");
} else {
  $id_message = $_GET['id_message'];
}

# On a besoin de l'id conversation pour rediriger au bon endroit
$id_conversation = $db->query("SELECT * FROM messages WHERE id = $id_message")->fetch()["id_conversation"];


if(empty($_SESSION["id"])) # On vérifie si l'utilisateur est connecté
{
  $_SESSION["message"] = "Vous devez vous connectez pour voter.";
  header("Location:messages.php?id=$id_conversation");

}
else # Sinon, on compte le nombre de vote déjà laissé par lui sur ce post pour pouvoir vérifier la deuxième condition
{
  $id_utilisateur = $_SESSION['id'];
  $query = $db->prepare("SELECT * FROM like_dislike WHERE id_utilisateur = ? AND id_message= ?");
  $query->execute([$id_utilisateur, $id_message]);
}

if($query->rowCount() > 0) # On vérifie si l'utilisateur n'a pas déja voté
{
  $_SESSION["message"] = "Vous avez déjà voté pour ce message";
  header("Location:messages.php?id=$id_conversation");

}
else # Si les deux sont faux, alors on peut ajouter le vote
{

  $req = $db->prepare("INSERT INTO like_dislike (id_message, id_utilisateur, like_dislike) VALUES(?, ?, ?)");
  $req->execute([$id_message, $id_utilisateur, $like_dislike]);
  $_SESSION["message"] = "Votre vote a bien été pris en compte";

  header("Location:messages.php?id=$id_conversation");

}

?>
