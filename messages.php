<?php
include("includes/identifiant.php");
include("includes/header.php");
/*if(!isset($_GET['id'])){ # Redirige vers topics lorsque l'on vient de like_dislike
  header("Location:topics.php");
}else
{ */
       # Permet d'afficher les messages appartenant à une conversation
      $id_conversation = $_GET['id'];
      $req = $db->prepare("SELECT * FROM conversations, messages
        WHERE messages.id_conversation = '$id_conversation' AND messages.id_conversation = conversations.id");
      $req->execute();?>

      <div class="messages">
        <h1 class= "messages_h1"> Titre de la conversation à placer ici </h1>
        <?php while ($post = $req->fetch())
        {
          ?>
          <article class="messages_article">
            <?php $id_message = $post['id'];
            # Permettra l'affichage du nombre de like :
            $query =  $db->prepare("SELECT COUNT(*) FROM like_dislike
              WHERE like_dislike = 1 AND id_message = '$id_message'");
            $query->execute();
            $nb_like = $query->fetchColumn();
            # Permettra l'affichage du nombre de dislike :
            $query =  $db->prepare("SELECT COUNT(*) FROM like_dislike
              WHERE like_dislike = 0 AND id_message = '$id_message'");
            $query->execute();
            $nb_dislike = $query->fetchColumn();
            ?>
            <p class="messages_login"> Posté par <?= $post['id_utilisateur'] ?>.</p>
            <p class="p_messages"><?= $post['message']; ?></p>


            <a class="a_signaler" href="messages.php?id=<?= $post['id'];?>&signaler=<?php $post['id']?>"> Signaler le message</a>

            <?php
            if(isset($_SESSION['id']))
            { # Affichage des boutons de vote uniquement si l'user est connecté ?>
            <div class="alignement_thumbs">
              <form method="post" action="like_dislike.php?id_message=<?php echo $id_message;?>">
                <button class="like-btn" name="like" type="submit"><i class=" fa fa-thumbs-up"></i> <?php echo $nb_like;  ?> </button>
              </form>
              <form action="like_dislike.php?id_message=<?php echo $id_message;?>" method="post">
                <button class="like-btn" name="dislike" type="submit"> <?php echo $nb_dislike;  ?> <i class="fa fa-thumbs-down"></i></button>
              </form>
            </div>

              <?php
            } ?>
          </article>

          <?php
          if(isset($_GET['signaler']))
          {
            $signalement = true;
            $id_message = $post['id'];
            $data_signalement = ['id_message' => $id_message];

            $sql_signaler ="INSERT INTO signaler (id_message) VALUES ('$id_message')";
            $stmt_signaler = $db->prepare($sql_signaler);
            $stmt_signaler->execute($data_signalement);
            echo "Le message a été signalé aux administrateurs.";
          }
        }
        ?>
      </div>

      <?php
      include("includes/bbcode.php"); # Permet d'ajouter des smileys ?>
      <center>


    <?php if(isset($_SESSION['login'])){
      ?>   <h2 class= "messages_h2">Poster une réponse</h2>

      <form method="post" action="" name="formulaire">
      <fieldset><legend class="messages_legend">Mise en forme</legend>
      <input type="button" id="gras" name="gras" value="Gras" onClick="javascript:bbcode('[g]', '[/g]');return(false)" />
      <input type="button" id="italic" name="italic" value="Italic" onClick="javascript:bbcode('[i]', '[/i]');return(false)" />
      <input type="button" id="souligné" name="souligné" value="Souligné" onClick="javascript:bbcode('[s]', '[/s]');return(false)" />
      <input type="button" id="lien" name="lien" value="Lien" onClick="javascript:bbcode('[url]', '[/url]');return(false)" />
      <br />
      <img  src="https://img.icons8.com/officexs/16/000000/lol.png" title="heureux" alt="heureux" onClick="javascript:smilies(' :D ');return(false)" />
      <img src="https://img.icons8.com/officexs/16/000000/tongue-out.png" title="lol" alt="lol" onClick="javascript:smilies(' :lol: ');return(false)" />
      <img src="https://img.icons8.com/officexs/16/000000/sad.png" title="triste" alt="triste" onClick="javascript:smilies(' :triste: ');return(false)" />
      <img src="https://img.icons8.com/officexs/16/000000/in-love.png" title="cool" alt="cool" onClick="javascript:smilies(' :frime: ');return(false)" />
      <img src="https://img.icons8.com/officexs/16/000000/cool.png" title="rire" alt="rire" onClick="javascript:smilies(' XD ');return(false)" />
      <img src="https://img.icons8.com/officexs/16/000000/confused.png" title="confus" alt="confus" onClick="javascript:smilies(' :s ');return(false)" />
      <img  src="https://img.icons8.com/officexs/16/000000/surprised.png" title="choc" alt="choc" onClick="javascript:smilies(' :o ');return(false)" />
      <img src="https://img.icons8.com/officexs/16/000000/question.png" title="?" alt="?" onClick="javascript:smilies(' :interrogation: ');return(false)" />
      <img src="https://img.icons8.com/officexs/16/000000/warning-shield.png" title="!" alt="!" onClick="javascript:smilies(' :exclamation: ');return(false)" />
      </fieldset>

      <fieldset><legend class="messages_legend"> Ecrire un message </legend><textarea cols="80" rows="8" id="message" name="message"></textarea></fieldset>

      <input type="reset" name = "Effacer" value = "Effacer"/>
      <input type="submit" name="envoyer" value="Envoyer" />

      </form>

  </div></center>

  <?php

  if(isset($_POST['envoyer'])){
    $message = $_POST['message'];
    $id_utilisateur = $_SESSION['id'];
    $id_conversation = $_GET['id'];

    $sql = "INSERT INTO messages (message, id_conversation, id_utilisateur, date_message)
      VALUES ('$message', '$id_conversation', '$id_utilisateur', NOW())";
    $stmt= $db->prepare($sql);
    $stmt->execute();
    echo "Le message a bien été posté.";
  }
}

else {

echo "pour répondre à cette conversation, connectez-vous!";

}

  ?>
  <p><a href="conversations.php">Retour aux conversations</a></p>
<?php include('includes/footer.php') ?>
</body>
</html>
