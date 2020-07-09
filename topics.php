
<?php

try
{
$db = new PDO('mysql:host=localhost;dbname=forum', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

 if(!isset($_GET["start"])) {
  $start = 0;
} else {
  $start = (int)$_GET["start"];
}

/* Conditions empêchant d'entrer des valeurs inexistantes dans $_GET['categorie']
et dans $_GET['start'] */
if(isset($_GET["topics"])) {

  $sql = "SELECT count(*) FROM `topics` WHERE id = ?";
  $result = $bdd->prepare($sql);
  $result->execute(array($_GET["topics"]));
  $nombre_resultats = $result->fetchColumn();

  if($nombre_resultats == 0) {
    header("Location:topics.php");
  }

  $sql = "SELECT count(*) FROM `conversations` WHERE id_categorie = ?";
  $result = $bdd->prepare($sql);
  $result->execute(array($_GET["topics"]));
  $nombre_articles = $result->fetchColumn();

  if($start > $nombre_articles){
    header("Location:topics.php");
  }
} else {
  $sql = "SELECT count(*) FROM `articles`";
  $result = $db->prepare($sql);
  $result->execute();
  $nombre_articles = $result->fetchColumn();

  if($start > $nombre_articles){
    header("Location:topics.php");
  }
}
include('includes/header.php');
?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
      <title>Forum</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="form.css">
    </head>

    <body>
      <header>
      </header>
      <?php

      # Permet de sélectionner les catégories existant dans la bdd
      if(isset($_GET["topics"])) {
        $categorie = $_GET["topics"];
        $count = (int)$db->query('SELECT COUNT(id) FROM conversations WHERE id_categorie = "$topics" LIMIT 5')->fetch(PDO::FETCH_NUM)[0];
      } else {
        $count = (int)$db->query('SELECT COUNT(id) FROM conversations LIMIT 5')->fetch(PDO::FETCH_NUM)[0];
      }
      $offset = (int)((!isset($_GET["start"])) ? 0 : $_GET["start"]);

      # Condition empêchant que l'offset soit négatif
      if ($offset < 0){
        $offset = 0;
      };

      ?>
      <main>
        <div class="topics_categorie">
          <h2> Tout les topics </h2>
          <?php
          # Affichage des catégories
          $reponse = $db->query('SELECT * FROM topics');
          while ($donnees = $reponse->fetch())
          {
          ?>
          <a href="topics.php?topic=<?php echo $donnees['id'];
          ?>" class="link_topics"> <?php  echo " ". $donnees['topic']; }?> </a>
        </div>

        <div class="topics">
          <?php
          if (isset($_GET['topic'])){
            $categorie = $_GET["topic"];

            // On récupère les 5 derniers articles
            $req = $db->query("SELECT * FROM `conversations`
                        WHERE id_topic = $categorie
                        ORDER BY date DESC LIMIT 5 OFFSET $offset");

            # $donnees est un array renvoyé par fetch, qui organise les champs de $req
            while ($donnees = $req->fetch()){
            ?>
              <div class="card_articles">
                <h2>  <?php echo htmlspecialchars($donnees['conversation']); ?> </h2>
                <p class="p_articles"><?php echo htmlspecialchars($donnees['id']); ?> </p>


                <em><a class="link_voir_article" href="article.php?id=<?php echo $donnees['id']; ?>"> Voir la conversation</a></em>
              </div>


          <?php
          }
          # Si aucune des conditions n'est remplie, afficher les 5 derniers articles
          }else{
            $req = $db->query("SELECT * FROM `conversations`
                        ORDER BY date DESC LIMIT 5 OFFSET $offset");

            # $donnees est un array renvoyé par fetch, qui organise les champs de $req
            while ($donnees = $req->fetch()){
              ?>


                <div class="card_articles">

                  <h2>  <?php echo htmlspecialchars($donnees['topic']); ?> </h2>
                  <p class="p_articles">  <?php echo htmlspecialchars($donnees['conversation']); ?> </p>
                  <em><a class="link_voir_article" href="article.php?id=<?php echo $donnees['id']; ?>">Voir la conversation</a></em>

                </div>

            <?php
            }
          };?>
        </div>

      <?php # Liens "Page précédente" et "Page suivante" ?>
      <div class="previous_next">
        <?php # Page précédente
        if($offset > 1){
          if(isset($_GET["topic"])) { ?>
            <a class="articles_boutons" href="topics.php?categorie=<?php echo $_GET["topic"]; ?>&start=<?php echo $offset - 5 ?>">&laquo; Page précédente </a>
            <?php } else { ?>
            <a class="articles_boutons" href="topics.php?start=<?php echo $offset - 5 ?>">&laquo; Page précédente </a>
            <?php
          }
        };
        # Page suivante
        if($offset + 5 < $count){
          if(isset($_GET["categorie"])) { ?>
            <a class= "articles_boutons" href="articles.php?categorie=<?php echo $_GET["categorie"]; ?>&start=<?php echo $offset + 5 ?>"> Page suivante &raquo;</a>
            <?php
          }else{ ?>
            <a class="articles_boutons" href="articles.php?start=<?php echo $offset + 5 ?>"> Page suivante &raquo;</a>
          <?php
          } ?>
      </div>
      <?php
      ;}
      // Termine la boucle des articles
      $req->closeCursor();
      ?>
    </main>

    <?php include("includes/footer.php"); ?>
  </body>
</html>
