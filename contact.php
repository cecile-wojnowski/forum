<?php
$titre = "Nous contacter";
include("includes/identifiant.php");
include("includes/header.php"); ?>

<center>
<img src="https://images.pexels.com/photos/1591062/pexels-photo-1591062.jpeg?cs=srgb&dl=cubes-e-mail-gros-plan-mot-1591062.jpg&fm=jpg" alt="" style="width:20%">
<div class="container">
<h4>Envoyez-nous un message</h4>
<?php if (isset($_SESSION['login']))
{ ?>
<form class="" action="" method="post">
  <label for="">Titre</label>
  <div class="titre_contact">
    <input type="text" name="titre" value="">
  </div>
<fieldset><legend class="messages_legend">Message</legend><textarea class="messages_textarea" name="message_contact" value="" cols="80" style="width:50%" rows="8"> </textarea>
</fieldset>
<input type="submit" name="submit" value="Envoyer">
</center>
</form>
</div>

<?php
    if(isset($_POST['submit']))
    {

        $titre_contact = $_POST['titre'];
        $message_contact = $_POST['message_contact'];
        $message_contact = str_replace("'", "\'", $message_contact); # Permet l'affichage des guillemets
        $id_utilisateur = $_SESSION['id'];

        $data = ['titre_contact' => $titre_contact, 'message_contact' => $message_contact, 'id_utilisateur' => $id_utilisateur, ];
        $sql = "INSERT INTO contact (titre_contact, message_contact, id_utilisateur) VALUES (:titre_contact, :message_contact, :id_utilisateur)";
        $stmt = $db->prepare($sql);
        $stmt->execute($data);

        echo "<center>Votre message a bien été envoyé !</center>";
    }

}
else
{
    echo "Vous devez vous connectez pour envoyer un message";

}

include('includes/footer.php');
?>

  </body>
</html>
