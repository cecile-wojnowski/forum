<?php
include("includes/header.php");
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/table.css">
  </head>

  <body>
    <?php
    # Gestion des utilisateurs réservée à l'admin
    /* Mettre admin dans une condition : if isset session admin, echo include admin */

    /*if(verif_auth(ADMIN))
    {*/
      //Afficher la partie admin
      include("includes/admin.php");
    /*}*/

    include("includes/moderation_topics.php");
    include("includes/moderation_messages.php");
    ?>

    <h2 class="h2_moderation"> Gestion des signalements : </h2>
    <?php
    # Afficher les messages signalés
    $sql = 'SELECT * FROM messages INNER JOIN signaler ON messages.id = signaler.id_message ';
    $params = [];
    $resultats = $db->prepare($sql);
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
      <?php
    } ?>

  </body>
</html>
