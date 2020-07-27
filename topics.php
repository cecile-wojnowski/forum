<?php
$titre = "Topics";
include("includes/identifiant.php");
include("includes/header.php");
include("includes/bbcode.php");
?>

<div class="topics">

  <?php
    if(isset($_SESSION["message"])) {
      echo $_SESSION["message"];
      unset($_SESSION["message"]);
    }

# Si une session est ouverte et que l'id_droit est celui des modérateurs ou des admins...
# On affiche tous les topics, qu'ils soient publics ou privés
if(isset($_SESSION['id_droits'])){
  if($_SESSION['id_droits'] == 3 OR 4)
  {
    $req = $db->query('SELECT * FROM topics');
    foreach($req->fetchAll() as $post):
    ?>
    <div class="card">
      <?php # Assigne une image de base si la bdd est vide
      if($post['image'] == NULL)
      { ?>
        <img src="img/forum1.webp" alt="Avatar" style="width:100%">
        <?php
      }else
      { ?>
        <img src="img/<?= $post['image'];?>" alt="Avatar" style="width:100%">
        <?php
      }
      ?>

      <div class="container">
        <h4><?= $post['topic']; ?></h4>
        <a href="conversations.php?id=<?= $post['id']; ?>">Voir les conversations</a>
      </div>
    </div>
    <?php endforeach;
  }
}else # Sinon, pour tous les autres utilisateurs, on affiche que les topics publics
{
  $req = $db->query('SELECT * FROM topics WHERE statut = "public"');
  foreach($req->fetchAll() as $post):
  ?>
  <div class="card">
    <?php # Assigne une image de base si la bdd est vide
    if($post['image'] == NULL)
    { ?>
      <img src="img/forum1.webp" alt="Avatar" style="width:100%">
      <?php
    }else
    { ?>
      <img src="img/<?= $post['image'];?>" alt="Avatar" style="width:100%">
      <?php
    }
    ?>
    <div class="container">
      <h4><?= $post['topic']; ?></h4>
      <a href="conversations.php?id=<?= $post['id']; ?>">Voir les conversations</a>
    </div>
  </div>
  <?php endforeach;
}

?>

</div>
    </main>

    <?php include("includes/footer.php"); ?>
  </body>
</html>
