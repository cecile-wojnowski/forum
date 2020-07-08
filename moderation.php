<?php
#include identifiant
include("includes/identifiant.php");
include("includes/header.php");

# include header
  /* Admin : affichage de certaines parties du code uniquement si l'admin est connecté
   - change les droits utilisateurs, peut supprimer les utilisateurs = afficher liste d'users
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
      /* Admin : gestion des utilisateurs */
      # Afficher la liste des utilisateurs
      $sql = 'SELECT * FROM utilisateurs';
      $params = [];
      $resultats = $bdd->prepare($sql);
      $resultats->execute($params);

      if ($resultats->rowCount() > 0)
      { ?>
        <table>
          <thead>
		 				<tr>
              <th> Id </th>
              <th> Login </th>
              <th> Email </th>
              <th> Date d'inscription </th>
              <th> Droits </th>
            </tr>
	 				</thead>
          <?php
          while ($d = $resultats->fetch(PDO::FETCH_ASSOC))
          {
            ?>
            <tbody>
              <tr>
                <td><?=$d['id'] ?></td>
                <td><?=$d['login'] ?></td>
                <td><?=$d['email'] ?></td>
                <td><?=$d['date_inscription'] ?></td>
                <td><?=$d['id_droits'] ?></td>
              </tr>
            </tbody>
          <?php } ?>
        </table>
        <?php
        $resultats->closeCursor();
      }
      ?>


  </body>
</html>
