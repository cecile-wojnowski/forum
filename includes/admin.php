<h2 class="h2_moderation"> Gestion des utilisateurs :</h2>
<?php
  /* Admin : gestion des utilisateurs :
  A ajouter :  - supprimer utilisateur */

  # Ajouter les autres champs de l'utilisateur pour que l'admin puisse modifier leurs informations ?
  if(isset($_GET['modifier_droits']))
  {
    $pdoselect = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = :id');
    $pdoselect ->bindValue(':id', $_GET['modifier_droits'], PDO::PARAM_INT);
    $executepdo= $pdoselect->execute();

    $info= $pdoselect->fetch();
    if (isset($_POST['modifier_droits']))
    {
      $id_droits=$_POST['id_droits'];
      $id= $_GET['modifier_droits'];
      $req = $bdd->prepare('UPDATE utilisateurs SET id_droits = :id_droits WHERE id = :id');
      $req->execute(array('id_droits' => $id_droits,'id' => $id));

      if ($req)
      {
        echo 'Modification enregistrée';
        header("location: moderation.php?modification");
      }
    }
      ?>
      <form name="modifier_droits" action="moderation.php" method="POST">
        <select name="id_droits" id="id_droits">
          <option value="1"> Utilisateur </option>
          <option value="2"> Modérateur </option>
          <option value="3"> Admin </option>
        </select>
        <td><input name="modifier_droits" type="submit" value="Modifier les droits"></td>
      </form>
      <?php

  } ?>

<?php # Affiche la liste des utilisateurs
  $sql = 'SELECT * FROM utilisateurs';
  $params = [];
  $resultats = $bdd->prepare($sql);
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
            <td><?=$d['date_inscription'] ?></td>
            <td><?=$d['id_droits'] ?></td>

            <td><a href="moderation.php?modifier_droits=<?php echo $d['id'] ?>">Modifier les droits</a></td>

          </tr>
        </tbody>
      <?php } ?>
    </table>
    <?php
    $resultats->closeCursor();
  }

  # Suppression d'un utilisateur:
  if (isset($_GET['supprimer_user'])) {
                    try {
                        $id = $_GET["supprimer_user"];
                        $req = $bdd->prepare("DELETE FROM utilisateurs WHERE id = $id");
                        $req->execute();
                        echo 'Utilisateur supprimé';
                        $delai = 1;
                        $url = 'moderation.php?deleted';
                        header("Refresh: $delai;url=$url");
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                }
  ?>


</html>
