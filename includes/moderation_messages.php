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
<tr>                <td><a href="moderation.php?modifier_message=<?php echo $d['id'] ?>"> Modifier </a></td></tr>
                <td><a href="moderation.php?supprimer_message=<?php echo $d['id'] ?>"> Supprimer </a></td></tr>
              <?php
            }
        } ?>
    </tbody>
  </table>

  <?php # Modification des messages
  if (isset($_GET['modifier_message']))
  {
      $pdoselect2 = $db->prepare('SELECT * FROM messages WHERE id= :id');
      $pdoselect2 ->bindValue(':id', $_GET['modifier_message'], PDO::PARAM_INT);
      $executepdo2= $pdoselect2->execute();
      $info2= $pdoselect2->fetch();

      if (isset($_POST['modifier_message']))
      {
          $message= $_POST['message'];
          $id_conversation= $_POST['id_conversation'];
          $id_utilisateur= $_POST['id_utilisateur'];

          $req2 = $bdd->prepare('UPDATE messages
            SET message = :message,
            id_conversation = :id_conversation,
            id_utilisateur = :id_utilisateur
            WHERE id = :id');

          $req2->execute(array(
            'message' => $message,
            'id_conversation' => $id_conversation,
            'id_utilisateur' => $id_utilisateur,
            ));
          if ($req2)
          {
              echo 'Modification enregistrée';
              header("location: moderation.php?messages");
          }
       }
       ?>
       <form name="modification_message" action="" method="POST">
         <table border="0" align="center" cellspacing="2" cellpadding="2">
           <tr align="center">
             <td> Message </td>
             <td><input type="textarea" name="message" value="<?php echo $info2['message'] ?>"></td>
           </tr>
           <tr align="center">
             <td> Id conversation </td>
             <td>
               <input type="number" name="id_conversation" value="insérer l'id de la conversation'" max="50" min="1">
             </td>
           </tr>
           <tr align="center">
             <td> Id utilisateur </td>
             <td>
               <input type="number" name="id_utilisateur" value="insérer l'id de l'utilisateur''" max="50" min="1">
             </td>
           </tr>
           <tr align="center">
             <td><input name="modifier_message" type="submit" value="Modifier le message"></td>
           </tr>
         </table>
       </form>
     <?php
   }
   # Suppression des topics
   if (isset($_GET['supprimer_message'])) {
                     try {
                         $id = $_GET["supprimer_message"];
                         $req = $db->prepare("DELETE FROM messages WHERE id = $id");
                         $req->execute();
                         echo 'Message supprimé.';
                         $delai = 1;
                         $url = 'moderation.php?messages';
                         header("Refresh: $delai;url=$url");
                     } catch (PDOException $e) {
                         echo "Erreur : " . $e->getMessage();
                     }
                 }?>
</div>
<?php include('includes/footer.php')  ?>
