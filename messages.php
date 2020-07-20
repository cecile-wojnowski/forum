<?php
include("includes/identifiant.php");
include("includes/header.php");
include("includes/bbcode.php");

if(isset($_GET['id']))
{
  # Permet d'afficher les messages appartenant à une conversation
  $req = $db->prepare('SELECT * FROM conversations, messages
    WHERE conversations.id= messages.id_conversation AND messages.id= ?');
  $req->execute(array($_GET['id']));

  while ($post = $req->fetch())
  {
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
            $signalement = true;
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

# Boutons like et dislike :

# Compte le nombre de like :
$query =  $db->prepare("SELECT COUNT(*) FROM like_dislike WHERE like_dislike = 1");
$query->execute();
$nb_like = $query->fetchColumn();

# Compte le nombre de dislike:
$query =  $db->prepare("SELECT COUNT(*) FROM like_dislike WHERE like_dislike = 0");
$query->execute();
$nb_dislike = $query->fetchColumn();

?>
<form method="post" action="">
  <button class="fa fa-thumbs-up like-btn" name="like" type="submit"/> <?php echo $nb_like;  ?> </button>
</form>

<form class="" action="" method="post">
  <button class="fa fa-thumbs-down like-btn" name="dislike" type="submit"> <?php echo $nb_dislike;  ?> </button>
</form>
<a href="#" class="fa fa-facebook"></a>

<?php
  if (isset($_POST['like']))
  {
    if(empty($_SESSION['id']))
    {
      echo "vous devez vous connectez pour voter.";
    }else{
      $id_utilisateur = $_SESSION['id'];
      $id_message = $_GET['id'];
      $like_dislike = true;

      $req = $db->prepare("INSERT INTO like_dislike (id_message, id_utilisateur, like_dislike)
      VALUES('$id_message', '$id_utilisateur', '$like_dislike')");
      $req->execute(array(
            'id_message' => $id_message,
            'id_utilisateur' => $id_utilisateur,
            'like_dislike' => $like_dislike));

            echo "Votre vote a été pris en compte";
        }
  }

  if (isset($_POST['dislike']))
  {
    if(empty($_SESSION['id']))
    {
      echo "vous devez vous connectez pour voter.";
    }else{
      $id_utilisateur = $_SESSION['id'];
      $id_message = $_GET['id'];
      $like_dislike = false;

      $req = $db->prepare("INSERT INTO like_dislike (id_message, id_utilisateur, like_dislike)
      VALUES('$id_message', '$id_utilisateur', '$like_dislike')");
      $req->execute(array(
            'id_message' => $id_message,
            'id_utilisateur' => $id_utilisateur,
            'like_dislike' => $like_dislike));

            echo "Votre vote a été pris en compte";
        }
  }

?></div>

<?php

?>
<center><h3>poster un message</h3>

  <?php if(isset($_SESSION['login'])){
    ?> <form  action="" method="post" name="message">
      <div>
        <label> Poster un message</label>
        <textarea id ="message" name="message" value=""required ></textarea>
      </div>
        <input name="envoyer" type="submit" value="Envoyer">
    </form>
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
}

else {

echo "pour répondre à cette conversation, connectez-vous!";

}


  ?>


      <p><a href="conversations.php">Retour aux conversations</a></p>
<?php include('includes/footer.php') ?>
</body>
</html>
