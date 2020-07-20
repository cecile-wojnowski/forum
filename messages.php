<?php
include("includes/identifiant.php");
include("includes/header.php");
include("includes/bbcode.php");

if(isset($_GET['id']))
{
  # Permet d'afficher les messages appartenant à une conversation
  $req = $db->prepare('SELECT * FROM conversations, messages
    WHERE conversations.id= messages.id_conversation');
  $req->execute(array($_GET['id']));

  while ($post = $req->fetch())
  {
    var_dump($post);
    var_dump($req);
   ?>
   <html>
      <head>
        <meta charset="utf-8" />
       	<link href="style.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="form.css">
      </head>
      <body>
        <article>
          <h1><?= $post['conversation']; ?></h1>
        </article>

        <div class="message">
          <article>
            <h1><?= $post['message']; ?></h1>
            <p><?= $post['id_utilisateur'] ?></p>
            <a href="messages.php?id=<?= $post['id'];?>&signaler=<?php $post['id']?>">signaler le message</a>
          </article>
          <?php
          if(isset($_GET['signaler']))
          {
            $id_message = $post['id'];

            $data_signalement = [
                'id_message' => $id_message,
                #'signalement' => $signalement,
            ];

            $sql_signaler ="INSERT INTO signaler (id_message) VALUES ('$id_message')";
            $stmt_signaler = $db->prepare($sql_signaler);
            $stmt_signaler->execute($data_signalement);

            echo "Le message a été signalé aux administrateurs.";
          }
  }
}
?>
<form method="post" action="">
  <button class="fa fa-thumbs-up like-btn" name="like" type="submit"/> <?php echo "0";  ?> </button>
</form>

<form class="" action="" method="post">
  <button class="fa fa-thumbs-down like-btn" name="dislike" type="submit"> <?php echo "0";  ?> </button>
</form>
<a href="#" class="fa fa-facebook"></a>

<?php
  if (isset($_POST['like']))
  {
    if(empty($_SESSION['id']))
    {
      echo "vous devez vous connectez pour voter";
    }else{
      $id_utilisateur = $_SESSION['id'];
      $id_message = $_GET['id'];
      $like_dislike = true;

      $req = $db->prepare('INSERT INTO like_dislike (id_message,id_utilisateur, like_dislike)
      VALUES(:id_message, :id_utilisateur, :like_dislike)');
      $req->execute(array(
            'id_message' => $id_utilisateur,
            'id_utilisateur' => $id_message,
            'like_dislike' => $like_dislike));

            echo "votre vote a été pris en compte";
        }
  }

?></div>

<?php

?>
<center>

  <?php if(isset($_SESSION['login'])){
    ?>   <h1>Poster une réponse</h1>

      <form method="post" action="" name="formulaire">
      <fieldset><legend>Mise en forme</legend>
      <input type="button" id="gras" name="gras" value="Gras" onClick="javascript:bbcode('[g]', '[/g]');return(false)" />
      <input type="button" id="italic" name="italic" value="Italic" onClick="javascript:bbcode('[i]', '[/i]');return(false)" />
      <input type="button" id="souligné" name="souligné" value="Souligné" onClick="javascript:bbcode('[s]', '[/s]');return(false)" />
      <input type="button" id="lien" name="lien" value="Lien" onClick="javascript:bbcode('[url]', '[/url]');return(false)" />
      <br /><br />
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


      <fieldset><legend>Message</legend><textarea cols="80" rows="8" id="message" name="message"></textarea></fieldset>

      <input type="reset" name = "Effacer" value = "Effacer"/>
      <input type="submit" name="envoyer" value="Envoyer" />

      </p></form>

  </div></center>

  <?php

  if(isset($_POST['envoyer'])){
    $message = $_POST['message'];
    $temps= date("d-m-Y-H:i");
    $id_utilisateur = $_SESSION['id'];
    $id_conversation = $_GET['id'];

      $data = [
          'message' => $message,
          'id_conversation' => $id_conversation,
          'id_utilisateur'=>$id_utilisateur,
          'temps' => $temps,
      ];

      $sql = "INSERT INTO messages (message, id_conversation, id_utilisateur, temps) VALUES (:message, :id_conversation, :id_utilisateur, :temps)";
      $stmt= $db->prepare($sql);
      $stmt->execute($data);
      echo "le message a bien été posté";
      var_dump($data);
  }
  var_dump($message);
}

else {

echo "pour répondre à cette conversation, connectez-vous!";

}


  ?>





      <p><a href="conversations.php">Retour aux conversations</a></p>
<?php include('includes/footer.php') ?>
</body>
</html>
