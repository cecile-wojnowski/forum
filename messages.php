<?php
include("includes/identifiant.php");
include("includes/header.php");
include("./includes/function.php");
require "class/vote.php";

?>


<?php


$req = $db->query('SELECT * FROM messages, conversations');
?>

<?php foreach($req->fetchAll() as $post):


   ?>

   <html>
       <head>
         <meta charset="utf-8" />
       	<link href="css/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="style.css">
       </head>


    <div class="message">
        <article>
            <h1><?= $post['message']; ?></h1>
            <p><?= $post['id_utilisateur'] ?></p>
        <a href="">signaler le message</a>

              		 <button class="fa fa-thumbs-up like-btn" name="like"><?php echo"0"  ?> </button>
                    <button class="fa fa-thumbs-down like-btn" name="dislike"> <?php echo "0"  ?> </button>

    </div>        </article>


<?php endforeach; ?>

<h3>poster un message</h3>



<?php
  if(isset($_POST['message'])){
    $message = $_POST['message'];
    $req = $db->prepare("INSERT INTO messages(message,id_conversation, id_utilisateur, date) VALUES(?, ?, ?, NOW())");
    $req->execute(array($commentaire, $_GET['id'], $_SESSION['id']));
    header("Refresh:0");
  }
  ?>

  <?php if(isset($_SESSION['login'])){
    ?> <form  action="article.php?id=<?php echo $_GET['id']; ?>" method="post" name="message">
      <div>
        <label> Poster un message</label>
        <textarea id = "commentaire" name="commentaire" value="" rows="5" cols="73"></textarea>
      </div>

      <div class="submit_commentaire">
        <input id="bouton_commentaire" type="submit" value="Envoyer">
      </div>
    </form>
  </div>
  <?php }

else {

echo "pour répondre à cette conversation, connectez-vous!";

}
   ?>


    <body>
      <p><a href="conversations.php">Retour aux conversations</a></p>

    </body>
</html>
