<div class="container_admin">
<h2 class="h2_moderation"> Gestion des topics : </h2>

<h3> Créer un nouveau topic : </h3>

<form name="creation_topic" class="" action="creation_topic.php" method="post">
  <label for="">Nom du topic</label>
   <input type="text" name="nom_topic" value="">
  <label for="">Numéro du topic</label>
   <input type="number" name="id" value="Insérer le numéro du topic" max="50" min="1">
  <label for=""> Statut public ou privé : </label>
  <select name="statut" id="statut">
    <option value="public"> Public </option>
    <option value="private"> Privé </option>
  </select>
  <input type="submit" name="creation_topic" value="Créer topic">
</form>

<?php # Affichage des topics
 ?>

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
        $resultats = $db->prepare($sql);
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
                 <td><a href="modifier_topic.php?id=<?php echo $d['id'] ?>"> Modifier </a></td>
       					 <td><a href="supprimer_topic.php?id=<?php echo $d['id'] ?>"> Supprimer </a></td>
               <?php
             }
         } ?>
     </tbody>
   </table>

</div>
