<?php
session_start();
include("includes/identifiant.php");

# Si l'utilisateur n'est pas connecté, il ne peut pas supprimer un message signalé
if (!isset($_SESSION["id"])) {
  $_SESSION["message"] = "Seul un utilisateur connecté peut supprimer un message signalé";
  header("Location:index.php");
} elseif($_SESSION["id_droits"] != 4) {
  $_SESSION["message"] = "Seuls les administrateurs peuvent supprimer un message signalé";
  header("Location:index.php");
} elseif(isset($_GET["id"])) {
  $id = $_GET["id"];
  $req = $db->prepare("DELETE FROM messages WHERE id = $id");
  $req->execute();
  $_SESSION["message"] = "Message supprimé";
  header("Location:moderation.php");
} else {
  header("Location:index.php");
}
?>
