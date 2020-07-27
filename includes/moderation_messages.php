<?php
# Gestion des messages accessible pour l'admin et le modérateur
# Affichage des messages ?>
<div class="container_admin">
<h2 class="h2_moderation"> Gestion des messages : </h2>
  <table>
    <thead>
      <tr>
        <th> Id </th>
        <th> Message </th>
        <th> Id conversation </th>
        <th> Id utilisateur </th>
      </tr>
    </thead>
    <tbody>
     <?php
       $sql = 'SELECT * FROM messages';
       $params = [];
       $resultats = $db->prepare($sql);
       $resultats->execute($params);
       if ($resultats->rowCount() > 0)
       {
          while ($d = $resultats->fetch(PDO::FETCH_ASSOC))
            {
              ?>
              <tr>
                <td><?=$d['id'] ?></td>
                <td><?=$d['message'] ?></td>
                <td><?=$d['id_conversation'] ?></td>
                <td><?=$d['id_utilisateur'] ?></td>
                <td><a href="modifier_message.php?id=<?= $d['id'] ?>"> Modifier </a></td>
                <td><a href="supprimer_message.php?id=<?= $d['id'] ?>"> Supprimer </a></td>
              </tr>
              <?php
            }
        } ?>
    </tbody>
  </table>

</div>
