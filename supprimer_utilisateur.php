<?php
session_start();
include("includes/identifiant.php");

# Si l'utilisateur n'est pas connecté, il ne peut pas supprimer un autre
if (!isset($_SESSION["id"])) {
  $_SESSION["message"] = "Seul un utilisateur connecté peut supprimer un utilisateur";
  header("Location:index.php");
} elseif($_SESSION["id_droits"] != 4) {
  $_SESSION["message"] = "Seuls les administrateurs peuvent supprimer des comptes";
  header("Location:index.php");
} elseif(isset($_GET["id"])) {
  $id = $_GET["id"];
  $req = $db->prepare("DELETE FROM utilisateurs WHERE id = $id");
  $req->execute();
  $_SESSION["message"] = "Utilisateur supprimé";
  header("Location:moderation.php");
} else {
  header("Location:index.php");
}
?>
