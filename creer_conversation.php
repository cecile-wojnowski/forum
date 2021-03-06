<?php
$titre = "Créer une conversation";
include("includes/identifiant.php");
include("includes/header.php");

if (isset($_SESSION['login']))
{
?>
<center>
<img style="width:25%"src="https://images.pexels.com/photos/461077/pexels-photo-461077.jpeg?cs=srgb&dl=a-l-interieur-brouiller-bureau-cahier-461077.jpg&fm=jpg" alt="">
<div class="container_creer_conv">
      <form method='post' action=''>
         Titre de la conversation: <input type='text' name='titre' /><br/>
         Contenu de la conversation:<br/> <textarea name='conversation' style="width:100%" placeholder="décrivez-ici votre question" /></textarea>
         <br/><label for="">Topic</label><br/>

         <select name="topic">
           <?php $reponse = $db->query('SELECT * FROM topics');

            // On affiche chaque entrée une à une
            while ($donnees = $reponse->fetch())
            {
              ?>
              <strong>catégorie</strong> : <?php echo "<option value = '" . $donnees["id"] . "'>" . $donnees['topic'] . "</option>";
            } ?>
          </select>
         <input type='submit' name='poster_conversation' value='Poster la conversation' />
      </form>
    </div>
  </center>

 <?php
    if (isset($_POST['poster_conversation']))
    {
        $titre = $_POST['titre'];
        $conversation = $_POST['conversation'];
        $conversation = str_replace("'", "\'", $conversation); # Permet l'affichage des guillemets
        $id_utilisateur = $_SESSION['id'];
        $id_topic = $_POST['topic'];
        $data = ['titre' => $titre, 'conversation' => $conversation, 'id_topic' => $id_topic, 'id_utilisateur' => $id_utilisateur, ];
        $sql = "INSERT INTO conversations (titre, conversation, id_topic, id_utilisateur) VALUES (:titre, :conversation, :id_topic, :id_utilisateur)";
        $stmt = $db->prepare($sql);
        $stmt->execute($data);

        echo "<center>votre nouvelle conversation a bien été postée !</center>";
    }

}
else
{
    echo "vous devez vous connectez pour créer une conversation";

}

include('includes/footer.php');
?>
