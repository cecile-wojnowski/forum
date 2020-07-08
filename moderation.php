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
    <?php
    # Gestion des utilisateurs réservée à l'admin
    include("includes/admin.php");
    include("includes/topics.php")?>

    <?php
    # Gestion des messages accessible pour l'admin et le modérateur ?>
    <h2 class="h2_moderation"> Gestion des messages : </h2>
      <table>
   		  <thead>
   			  <tr>
            <th> Id </th>
            <th> Message </th>
          </tr>
   		  </thead>
   		  <tbody>
   			 <?php
           $sql = 'SELECT * FROM messages';
           $params = [];
           $resultats = $bdd->prepare($sql);
           $resultats->execute($params);
           if ($resultats->rowCount() > 0)
           {
              while ($d = $resultats->fetch(PDO::FETCH_ASSOC))
                {
                  ?>
         					<tr>
                    <td><?=$d['id'] ?></td>
                    <td><?=$d['message'] ?></td>
                  <?php
                }
            } ?>
        </tbody>
      </table>

        <h2 class="h2_moderation"> Gestion des signalements : </h2>
        <?php
        # Si l'id de la table messages est identique à l'id_message de signaler, afficher ici ?>

  </body>
</html>
