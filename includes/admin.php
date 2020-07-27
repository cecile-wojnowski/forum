<div class="container_admin">
  <h2 class="h2_moderation"> Gestion des utilisateurs :</h2>

<?php # Affiche la liste des utilisateurs
  $sql = 'SELECT * FROM utilisateurs';
  $params = [];
  $resultats = $db->prepare($sql);
  $resultats->execute($params);

  if ($resultats->rowCount() > 0)
  {
    ?>
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
            <td><?=date('d/m/Y', $d['date_inscription']) ?></td>
            <td><?=$d['id_droits'] ?></td>
            <td><a href="modifier_utilisateur.php?id=<?= $d['id']; ?>">Modifier l'utilisateur</a></td>
            <td><a href="supprimer_utilisateur.php?id=<?= $d['id']; ?>">Supprimer l'utilisateur </a></td>
          </tr>
        </tbody>
      <?php } ?>
    </table>
    <?php
    $resultats->closeCursor();
  }

  ?>
</div>
