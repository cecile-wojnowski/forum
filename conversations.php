<?php
$titre = "Conversations";
include("includes/identifiant.php");
include("includes/header.php");
include("includes/bbcode.php");

if(isset($_GET['id']))
{

    $req = $db->prepare('SELECT * FROM topics
  JOIN conversations ON topics.id = conversations.id_topic
  WHERE id_topic = ?');
    $req->execute(array(
        $_GET['id']
    ));

    while ($post = $req->fetch())
    {
      $conversation = $post['conversation'];
      $conversation = str_replace("\'", "'", $conversation);

?>


  <article class="conversations">
    <h1 class="h1_conversations"><?=$post['titre']; ?></h1>
    <p><?=$conversation ?></p>
    <p>
      <a href="messages.php?id=<?=$post['id']; ?>">Lire la suite</a>
    </p>
  </article>

<?php
    }
}

?>

<p><a class="a_conversations" href="topics.php">Retour aux Topics</a></p>

<?php include("includes/footer.php");?>
