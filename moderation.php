<?php
include ("includes/header.php");
?>
<html>
  <body>

    <?php
    if (isset($_SESSION["message"]))
    { ?>
                <p class="messages_text"> <?php echo $_SESSION["message"]; ?> </p>
                  <?php unset($_SESSION["message"]);
    }
# Gestion des utilisateurs réservée à l'admin
if ($_SESSION['id_droits'] == 4)
{
    //Afficher la partie admin
    include ("includes/admin.php");
}

include ("includes/moderation_topics.php");
include ("includes/moderation_messages.php");
?>

    <h2 class="h2_moderation"> Gestion des signalements : </h2>
    <?php
# Afficher les messages signalés
$sql = 'SELECT messages.id, message FROM messages INNER JOIN signaler ON messages.id = signaler.id_message ';
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
              <td><a href="supprimer_signalement.php?id=<?= $d['id']; ?>"> Supprimer le message </a></td>
            </tr>
          </tbody>
        <?php
    } ?>
      </table>
      <?php
}

include("includes/footer.php");
?>

  </body>
</html>
