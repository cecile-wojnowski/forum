


<?php

include("includes/identifiant.php");
include("includes/header.php");
include("./includes/function.php");
include("includes/bbcode.php");
require "class/vote.php";
?>

   <!DOCTYPE html>
   <html lang="en" dir="ltr">
     <head>
       <meta charset="utf-8">
       <link rel="stylesheet" href="style.css">
       <title>Topics</title>
     </head>
     <body>

<div class="topics">

<?php
$req = $db->query('SELECT * FROM topics ');

foreach($req->fetchAll() as $post):

   ?>



<div class="card">
  <img src="img/forum1.webp" alt="Avatar" style="width:100%">
  <div class="container">
    <h4><?= $post['topic']; ?></h4>
<p> <a href="conversations.php?id=<?= $post['id']; ?>">Voir les conversations</a></p>
  </div>
</div>


<?php endforeach;
?>

</div>

    </main>

    <?php include("includes/footer.php"); ?>
  </body>
</html>
