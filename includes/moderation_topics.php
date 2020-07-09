<?php
# Création/modification/suppression de topics accessible pour l'admin et le modérateur

# Création de topics
if (isset($_POST['creer_topic'])) {
  $id_topic = $_POST['id'];
  $nom_topic = $_POST['nom_topic'];
  $statut = $_POST['statut'];

  $bdd->exec("INSERT INTO `topics`(`id`, `nom`, 'statut') VALUES ( '$id_topic','$nom_topic', '$statut')");
  echo 'Le topic a été créé.';
}
?>
<form name="creation_topic" class="" action="moderation.php" method="post">
  <label for="">Nom du topic</label>
   <input type="text" name="nom_topic" value="">
  <label for="">Numéro du topic</label>
   <input type="number" name="id" value="Insérer le numéro du topic" max="50" min="1">
  <label for=""> Statut public ou privé : </label>
  <select name="statut" id="statut">
    <option value="public"> Public </option>
    <option value="privé"> Privé </option>
  </select>
  <input type="submit" name="creer" value="creer_topic">
</form>

<?php # Affichage des topics
 ?>
 <h2 class="h2_moderation"> Gestion des topics : </h2>
   <table>
      <thead>
        <tr>
         <th> Id </th>
         <th> Topic </th>
         <th> Statut </th>
       </tr>
      </thead>
      <tbody>
       <?php
        $sql = 'SELECT * FROM topics';
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
                 <td><?=$d['topic'] ?></td>
                 <td><?=$d['statut'] ?></td>
                 <td><a href="moderation.php?modifier_topic=<?php echo $d['id'] ?>"> Modifier </a></td>
       					 <td><a href="moderation.php?supprimer_topic=<?php echo $d['id'] ?>"> Supprimer </a></td>
               <?php
             }
         } ?>
     </tbody>
   </table>

   <?php # Modification des topics
   if (isset($_GET['modifier_topic']))
   {
       $pdoselect2 = $bdd->prepare('SELECT * FROM topics WHERE id= :id');
       $pdoselect2 ->bindValue(':id', $_GET['modifier_topic'], PDO::PARAM_INT);
       $executepdo2= $pdoselect2->execute();
       $info2= $pdoselect2->fetch();

       if (isset($_POST['modifier_topic']))
       {
           $topic= $_POST['topic'];
           $statut= $_POST['statut'];

           $req2 = $bdd->prepare('UPDATE topics
             SET topic = :topic,
             statut = :statut
             WHERE id = :id');

           $req2->execute(array(
           'topic' => $topic,
           'statut' => $statut,
           ));
           if ($req2)
           {
               echo 'Modification enregistrée';
               header("location: moderation.php?topics");
           }
        }
        ?>
        <form name="modification_topic" action="" method="POST">
          <table border="0" align="center" cellspacing="2" cellpadding="2">
            <tr align="center">
              <td> Nom du topic </td>
              <td><input type="text" name="topic" value="<?php echo $info2['topic'] ?>"></td>
            </tr>
            <tr align="center">
  						<td> Statut </td>
  						<td>
                <select name="statut" id="statut">
                  <option value="public"> Public </option>
                  <option value="private"> Privé </option>
                </select>
              </td>
            </tr>
            <tr align="center">
              <td><input name="modifier_topic" type="submit" value="Modifier topic"></td>
            </tr>
          </table>
        </form>
      <?php
    }
    # Suppression des topics
    if (isset($_GET['supprimer_topic'])) {
                      try {
                          $id = $_GET["supprimer_topic"];
                          $req = $bdd->prepare("DELETE FROM topics WHERE id = $id");
                          $req->execute();
                          echo 'Topic supprimé.';
                          $delai = 1;
                          $url = 'moderation.php?topics';
                          header("Refresh: $delai;url=$url");
                      } catch (PDOException $e) {
                          echo "Erreur : " . $e->getMessage();
                      }
                  }?>