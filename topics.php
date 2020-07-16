
<?php

include("includes/identifiant.php");
include("includes/header.php");
include("./includes/function.php");
require "class/vote.php";

$req = $db->query('SELECT * FROM topics ');

foreach($req->fetchAll() as $post):

   ?>

    <div>
        <article>
            <h1><?= $post['topic']; ?></h1>
            <p>
                <a href="conversations.php?id=<?= $post['id']; ?>">Voir les conversations</a>
            </p>
        </article>

    </div>

<?php endforeach;

if(isset($_GET['conversations'])){

}


?>

    </main>

    <?php include("includes/footer.php"); ?>
  </body>
</html>
