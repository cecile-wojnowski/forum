
<?php
include("includes/identifiant.php");
include("includes/header.php");
include("includes/bbcode.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>



<?php
if(isset($_GET['id'])){

$req = $db->prepare('SELECT * FROM topics, conversations WHERE topics.id= conversations.id_topic AND conversations.id= ?');
$req->execute(array($_GET['id']));

while ($post = $req->fetch())
{

   ?>

    <div>
        <article>
            <h1><?= $post['titre']; ?></h1>
            <p><?= $post['conversation'] ?></p>
            <p>
                <a href="messages.php?id=<?= $post['id']; ?>">Lire la suite</a>
            </p>
        </article>

    </div>

<?php
}
}

?>

<p><a href="topics.php">Retour aux Topics</a></p>


<?php  include("includes/footer.php");
?>
</body>
</html>
