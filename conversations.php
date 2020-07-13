
<?php
include("includes/identifiant.php");
include("includes/header.php");
include("./includes/function.php");
require "class/vote.php";

$req = $db->query('SELECT * FROM conversations, messages');

foreach($req->fetchAll() as $post):

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

<?php endforeach;

?>

<p><a href="topics.php">Retour aux Topics</a></p>


<?php  include("includes/footer.php");
?>
