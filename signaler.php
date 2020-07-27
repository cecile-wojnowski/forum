<?php
session_start();
include("includes/identifiant.php");
if (isset($_SESSION["id"]))
{
    $id_message = $_GET['id_message'];
    $id_conversation = $_GET['id_conversation'];

    $stmt_signaler = $db->prepare("INSERT INTO signaler (id_message) VALUES (?)");
    $stmt_signaler->execute([$id_message]);

    $_SESSION["message"] = "Le message a été signalé aux administrateurs.";
    header("Location:messages.php?id=$id_conversation");
}
else
{
    $_SESSION["message"] = "Vous devez être connecté pour signaler un message";
    header("Location:topics.php");
}
?>
