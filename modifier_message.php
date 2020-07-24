<?php
include("includes/identifiant.php");
include("includes/header.php");

# Si le formulaire est déjà rempli, on fait la modification et on redirige
if (isset($_POST['message']))
{
  $id = $_GET["id"];
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
    'id' => $id
    ));
  if ($req2)
  {
      echo 'Modification enregistrée';
      header("location: moderation.php?messages");
  }
}


# Si l'utilisateur n'est pas connecté, il ne peut pas supprimer un autre
if (!isset($_SESSION["id"])) {
  $_SESSION["message"] = "Seul un utilisateur connecté peut modifier un topic";
  header("Location:index.php");
} elseif($_SESSION["id_droits"] != 4 AND $_SESSION["id_droits"] != 3) {
  $_SESSION["message"] = "Seuls les administrateurs ou les modérateurs peuvent modifier des topics";
  header("Location:index.php");
} elseif(isset($_GET["id"])) {
  $id = $_GET["id"];
  $pdoselect2 = $db->prepare('SELECT * FROM messages WHERE id= :id');
  $pdoselect2 ->bindValue(':id', $id, PDO::PARAM_INT);
  $executepdo2= $pdoselect2->execute();
  $info2= $pdoselect2->fetch();
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
   </form>  <?php
   } else {
    header("Location:index.php");
   }
   include("includes/footer.php");
   ?>
