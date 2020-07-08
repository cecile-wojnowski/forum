<?php 
# Création de topics accessible pour l'admin et le modérateur
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
               <?php
             }
         } ?>
     </tbody>
   </table>
