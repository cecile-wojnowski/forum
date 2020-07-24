<?php
include("includes/identifiant.php");
include("includes/header.php");
if(!isset($_GET['id'])){ # Redirige vers topics lorsque l'on vient de like_dislike
  header("Location:topics.php");
} else {
  $id_conversation = $_GET['id'];
}
       ?>

      <div class="messages">
        <h1 class= "messages_h1">
          <?php
            $req_titre = $db->prepare("SELECT titre FROM conversations WHERE id = ?");
            $req_titre->execute([$id_conversation]);
            echo $req_titre->fetch()["titre"];
          ?>
        </h1>
        <p>
          <?php
            if(isset($_SESSION["message"])) {
              echo $_SESSION["message"];
              unset($_SESSION["message"]);
            }
          ?>
        </p>
        <?php
        # Permet d'afficher les messages appartenant à une conversation
       $req = $db->prepare("SELECT messages.id, login, message
         FROM conversations
         JOIN messages ON messages.id_conversation = conversations.id
         JOIN utilisateurs ON utilisateurs.id = messages.id_utilisateur
         WHERE messages.id_conversation = '$id_conversation'");
       $req->execute();
        while ($post = $req->fetch())
        {
          # Permettra l'affichage du nombre de like
          $query =  $db->prepare("SELECT COUNT(*) FROM like_dislike WHERE like_dislike = 1 AND id_message = ?");
          $query->execute([$post["id"]]);
          $nb_like = $query->fetch()[0];
          # Permettra l'affichage du nombre de dislike
          $query =  $db->prepare("SELECT COUNT(*) FROM like_dislike WHERE like_dislike = 0 AND id_message = ?");
          $query->execute([$post["id"]]);
          $nb_dislike = $query->fetch()[0];
          ?>
          <article class="messages_article">
            <p class="messages_login"> Posté par <?= $post['login']; ?>.</p>
            <p class="p_messages"><?= $post['message']; ?></p>
            <a class="a_signaler" href="signaler.php?id_message=<?= $post['id'];?>&id_conversation=<?= $id_conversation; ?>"> Signaler le message</a>
            <?php
            if(isset($_SESSION['id']))
            { # Affichage des boutons de vote uniquement si l'user est connecté ?>
              <div class="alignement_thumbs">
                <form action="like.php?id_message=<?= $post['id'];?>" method="post">
                  <button class="like-btn" name="like" type="submit"> <?= $nb_like;  ?><i class=" fa fa-thumbs-up"></i> </button>
                </form>
                <form action="dislike.php?id_message=<?= $post['id'];?>" method="post">
                  <button class="like-btn" name="dislike" type="submit"> <?= $nb_dislike;  ?> <i class="fa fa-thumbs-down"></i></button>
                </form>
              </div>

              <?php } ?>
          </article>

          <?php
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

      <fieldset><legend class="messages_legend"> Ecrire un message </legend><textarea cols="80" rows="8" id="messages_textarea" name="message"></textarea></fieldset>

      <input type="reset" name = "Effacer" value = "Effacer"/>
      <input type="submit" name="envoyer" value="Envoyer" />

      </form>

  </div></center>

  <?php

  if(isset($_POST['envoyer'])){
    $message = $_POST['message'];
    $id_utilisateur = $_SESSION['id'];
    $id_conversation = $_GET['id'];

    $message = str_replace("'", "\'", $message);

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
  <p><a class="messages_retour" href="conversations.php">Retour aux conversations</a></p>
<?php include('includes/footer.php') ?>
</body>
</html>
