<?php
include("includes/identifiant.php");
include("includes/header.php");

# Si le formulaire a déjà été rempli, on fait la modification et on redigire
if (isset($_POST['topic']))
{
   $id = $_GET['id'];
   $topic= $_POST['topic'];
   $statut= $_POST['statut'];

   $req2 = $db->prepare("UPDATE topics SET topic = '$topic', statut = '$statut' WHERE id = '$id'");
   $req2->execute();
   $_SESSION["message"] = 'Modification enregistrée.';
   header("Location:moderation.php");
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
  $pdoselect2 = $db->prepare('SELECT * FROM topics WHERE id= :id');
  $pdoselect2 ->bindValue(':id', $id, PDO::PARAM_INT);
  $executepdo2= $pdoselect2->execute();
  $info2= $pdoselect2->fetch();
  ?>
  <form name="modification_topic" action="modifier_topic.php?id=<?= $id; ?>" method="POST">
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
} else {
 header("Location:index.php");
}
include("includes/footer.php");
?>
