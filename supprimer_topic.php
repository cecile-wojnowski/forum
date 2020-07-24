<?php
session_start();
include("includes/identifiant.php");

# Si l'utilisateur n'est pas connecté, il ne peut pas supprimer un autre
if (!isset($_SESSION["id"])) {
  $_SESSION["message"] = "Seul un utilisateur connecté peut supprimer un utilisateur";
  header("Location:index.php");
} elseif($_SESSION["id_droits"] != 4 AND $_SESSION["id_droits"] != 3) {
  $_SESSION["message"] = "Seuls les administrateurs ou les modérateurs peuvent supprimer des comptes";
  header("Location:index.php");
} elseif(isset($_GET["id"])) {
  $id = $_GET["id"];
  $req = $db->prepare("DELETE FROM topics WHERE id = $id");
  $req->execute();
  $req = $db->prepare("DELETE FROM messages WHERE id_conversation IN (SELECT id FROM conversations WHERE id_topic = $id)");
  $req->execute();
  $req = $db->prepare("DELETE FROM conversations WHERE id_topic = $id");
  $req->execute();
  $_SESSION["message"] = "Topic supprimé";
  header("Location:moderation.php");
} else {
  header("Location:index.php");
}
?>
