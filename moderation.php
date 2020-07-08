<?php
#include identifiant
include("includes/identifiant.php");
include("includes/header.php");

# include header
  /* Admin : affichage de certaines parties du code uniquement si l'admin est connecté
   - change les droits utilisateurs, peut supprimer les utilisateurs
   gérer les messages signalés = afficher liste messages signalés, possibilité de supprimer (requête)
    ajouter/ supprimer les topics = afficher liste des topics + requête d'ajout et de suppression

   Modérateur :
   - gère les messages signalés, ajoute/supprime les topics */

   # include footer
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Modération</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/table.css">
  </head>

  <body>
    <?php include("includes/admin.php");

      # Affichage des messages
      ?>


  </body>
</html>
