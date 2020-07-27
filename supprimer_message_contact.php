<?php
session_start();
include("includes/identifiant.php");

if (!isset($_SESSION["id"])) {
  $_SESSION["message"] = "Seul un utilisateur connecté peut supprimer un message";
  header("Location:index.php");
} elseif($_SESSION["id_droits"] != 4 AND $_SESSION["id_droits"] != 3) {
  $_SESSION["message"] = "Seuls les administrateurs ou les modérateurs peuvent supprimer un message";
  header("Location:index.php");
} elseif(isset($_GET["id"])) {
  $id = $_GET["id"];
  $req = $db->prepare("DELETE FROM contact WHERE id = $id");
  $req->execute();
  $_SESSION["message"] = "Message supprimé";
  header("Location:moderation.php");
} else {
  header("Location:index.php");
}
?>
