<?php
include("includes/identifiant.php");
include("includes/header.php");
include("./includes/function.php");
include("includes/bbcode.php");

?>

<?php
if(isset($_GET['id'])){
$req = $db->prepare('SELECT * FROM conversations, messages WHERE conversations.id= messages.id_conversation AND messages.id= ?');
$req->execute(array($_GET['id']));

while ($post = $req->fetch())
{

   ?>

   <html>
       <head>
         <meta charset="utf-8" />
       	<link href="css/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="style.css">
       </head>
<body>

    <div class="message">
        <article>
            <h1><?= $post['message']; ?></h1>
            <p><?= $post['id_utilisateur'] ?></p>
        <a href="messages.php?signaler">signaler le message</a>

          </article>

<form method="post" action="">
  <button class="fa fa-thumbs-up like-btn" name="like" type="submit"/> <?php echo "0";  ?> </button>
</form>

<form class="" action="" method="post">
  <button class="fa fa-thumbs-down like-btn" name="dislike" type="submit"> <?php echo "0";  ?> </button>

</form>
<?php

/* Pour empêcher l'accès à un article inexistant :
On compte le nombre d'article avec id = $_GET["id"]
Si il est égal à 0, on redirige */
$sql = "SELECT count(*) FROM messages WHERE id = ?";
$result = $db->prepare($sql);
$result->execute(array($_GET["id"]));
$nombre_resultats = $result->fetchColumn();

if($nombre_resultats == 0) {
  header("Location:conversations.php");
}

if (isset($_POST['like'])){

  if(empty($_SESSION['id'])){

echo "vous devez vous connectez pour voter";

}else{

$id_utilisateur = $_SESSION['id'];
$id_message = $_GET['id'];
$like_dislike = true;

  $req = $db->prepare('INSERT INTO like_dislike (id_message,id_utilisateur, like_dislike) VALUES(:id_message, :id_utilisateur, :like_dislike)');
  $req->execute(array(
      'id_message' => $id_utilisateur,
      'id_utilisateur' => $id_message,
      'like_dislike' => $like_dislike));

echo "votre vote a été pris en compte";
}
}

?></div>

<?php
}
}

?>
<h3>poster un message</h3>

  <?php if(isset($_SESSION['login'])){
    ?> <form  action="messages.php?id=<?php echo $_GET['id']; ?>" method="post" name="message">
      <div>
        <label> Poster un message</label>
        <textarea id = "message" name="message" value=""required ></textarea>
      </div>

      <div class="submit_commentaire">
        <input id="bouton_commentaire" name="message" type="submit" value="Envoyer">
      </div>
    </form>
  </div>
  <?php

  if(isset($_POST['message'])){
    $message = $_POST['message'];
    $date= date("H:i");
    $req2 = $db->prepare("INSERT INTO messages(message,id_conversation, id_utilisateur, date) VALUES(?, ?, ?, NOW())");
    $req2->execute(array($message, $_GET['id'], $_SESSION['id'], $date));
    header('Location: messages.php');
  }

var_dump($req2);}

else {

echo "pour répondre à cette conversation, connectez-vous!";

}


  ?>


      <p><a href="conversations.php">Retour aux conversations</a></p>

</body>
</html>
