<?php
#include identifiant
include("includes/identifiant.php");
include("includes/header.php");

#
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
    /* Mettre admin dans une condition : if isset session admin, echo include admin */
    include("includes/admin.php");

    include("includes/moderation_topics.php");
    include("includes/moderation_messages.php");
    ?>

    <h2 class="h2_moderation"> Gestion des signalements : </h2>
    <?php
    # Afficher les messages signalés
    $sql = 'SELECT * FROM messages INNER JOIN signaler ON messages.id = signaler.id_message ';
    $params = [];
    $resultats = $bdd->prepare($sql);
    $resultats->execute($params);

    if ($resultats->rowCount() > 0)
    {
      ?>
      <table>
        <thead>
          <tr>
            <th> Message </th>
          </tr>
        </thead>
        <?php
        while ($d = $resultats->fetch(PDO::FETCH_ASSOC))
        {
          ?>
          <tbody>
            <tr>
              <td><?=$d['message'] ?></td>
              <td><a href="moderation.php?supprimer_message=<?php echo $d['id'] ?>"> Supprimer le message </a></td>
            </tr>
          </tbody>
        <?php } ?>
      </table>
    <?php } ?>

  </body>
</html>
