<h2 class="h2_moderation"> Gestion des utilisateurs :</h2>
<?php
  /* Admin : gestion des utilisateurs */

  # Modification des droits
  if(isset($_GET['modifier_droits']))
  {
    $pdoselect = $db->prepare('SELECT * FROM utilisateurs WHERE id = :id');
    $pdoselect ->bindValue(':id', $_GET['modifier_droits'], PDO::PARAM_INT);
    $executepdo= $pdoselect->execute();
    $info= $pdoselect->fetch();

    $id = $_GET['modifier_droits'];
      ?>
      <form name="modification_droits" action="moderation.php?modifier_droits=<?php echo $id ?>" method="POST">
        <table border="0" align="center" cellspacing="2" cellpadding="2">
					<tr align="center">
						<td> Login </td>
						<td><input type="text" name="login" value="<?php echo $info['login']; ?>"></td>
					</tr>
					<tr align="center">
						<td> E-mail </td>
						<td><input type="text" name="email"value="<?php echo $info['email'] ; ?>"></td>
					</tr>
          <tr align="center">
						<td> Mot de passe </td>
						<td><input type="password" name="password" value="<?php echo $info['password'] ?>"></td>
					</tr>
          <tr align="center">
						<td> Date d'inscription </td>
						<td><input type="date" name="date" value="<?php echo $info['date_inscription'] ?>"></td>
					</tr>
          <tr align="center">
						<td> Id_droits </td>
						<td>
              <select name="id_droits" id="id_droits">
                <option value="2"> Utilisateur </option>
                <option value="3"> Modérateur </option>
                <option value="4"> Admin </option>
                <option value="5"> Banni </option>
              </select>
            </td>
          </tr>
          <tr align="center">
						<td> Localisation </td>
						<td><input type="text" name="localisation" value="<?php echo $info['localisation'] ?>"></td>
					</tr>
          <tr align="center">
						<td> Site web </td>
						<td><input type="text" name="website" value="<?php echo $info['website'] ?>"></td>
					</tr>
          <tr align="center">
						<td> Signature</td>
						<td><input type="text" name="signature" value="<?php echo $info['signature'] ?>"></td>
					</tr>
          <tr align="center">
						<td> Avatar </td>
						<td><input type="image" name="avatar" value="<?php echo $info['avatar'] ?>"></td>
					</tr>
          <td><input name="modification_droits" type="submit" value="Modifier les droits"></td>
        </table>
      </form>
      <?php

      if (isset($_POST['modification_droits']))
      {
        $id_droits = $_POST['id_droits'];

        $req = $db->prepare('UPDATE utilisateurs SET id_droits = :id_droits WHERE id = :id');
        $req->execute(array(
          'id_droits' => $id_droits,
          'id' => $id));

        echo 'Modification enregistrée';
      }
  } ?>

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
            <td><?=$d['date_inscription'] ?></td>
            <td><?=$d['id_droits'] ?></td>
            <td><a href="moderation.php?modifier_droits=<?php echo $d['id'] ?>">Modifier les droits</a></td>
            <td><a href="moderation.php?supprimer_user=<?php echo $d['id'] ?>"> Supprimer l'utilisateur </a></td>
          </tr>
        </tbody>
      <?php } ?>
    </table>
    <?php
    $resultats->closeCursor();
  }

  # Suppression d'un utilisateur:
  if (isset($_GET['supprimer_user']))
  {
    try
    {
      $id = $_GET["supprimer_user"];
      $req = $db->prepare("DELETE FROM utilisateurs WHERE id = $id");
      $req->execute();
      echo 'Utilisateur supprimé';
      $delai = 1;
      $url = 'moderation.php?deleted';
      header("Refresh: $delai;url=$url");
    } catch (PDOException $e)
    {
      echo "Erreur : " . $e->getMessage();
    }
  }

  # Bannissement :
  ?>
  <h2 class="h2_moderation"> Bannissement :</h2>
  <p class="p_admin"> Quel membre voulez-vous bannir ?</p>
    <form method="post" name="form_bannissement" action="moderation.php?action=ban">
      <label for="membre"> Inscrivez le pseudo : </label>
      <input type="text" id="membre" name="membre">
      <input type="submit"name="form_bannissement" value="Envoyer"><br />
    </form>
  <?php
  if(isset($_POST['form_bannissement']))
  {
    $query = $db->query('SELECT id, login
        FROM utilisateurs WHERE id_droits = 0');
        if ($query->rowCount() > 0)
        {
          while($data = $query->fetch()) # A adapter !
          {
            ?>
            <td><?=$data['login'] ?></td>
            <input type="checkbox" name="<?php$data['id']?>"/>
            Débannir<br />
            <?php
          } ?>
            <p><input type="submit" value="Débannir" /></p></form>
            <?php
        }
        else echo '<p>Aucun membre banni pour le moment :p</p>';
        $query->CloseCursor();
  }
  ?>

</html>
