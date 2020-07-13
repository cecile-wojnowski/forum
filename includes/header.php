<?php
    include("identifiant.php");
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $titre; ?></title>
    <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="header.css">
  </head>

  <body>
    <div class="top">
      <div class="top_text">
        <h2> Titre du forum</center> </h2>
      </div>

    </div>
    <?php
      $message = "";

      if (isset($_SESSION['login'])) {
        if ($_SESSION['id_droits']== 1) {
          ?> '<ul> <a href="index.php"><center>Accueil</center></a>
          <li><a href="profil.php">  Votre profil <i> <?php $_SESSION['login'] ?></i></a></li>
          <li><a href="topics.php"> Topics  </a></li>
          <li><a href="index.php?deconnexion">déconnexion</a></li></ul>
          <?php } elseif ($_SESSION['id_droits']== 2) { ?>
                <ul> <li><a href="index.php">Accueil</a></li>
                  <li><a href="profil.php">  Votre profil    <i><?php $_SESSION['login']?></i></a></li>
                  <li><a href="topics.php"> les topics  </a> </li>
                  <li><a href="index.php?deconnexion"><img src="https://img.icons8.com/fluent/48/000000/shutdown.png"/></a></li></ul>
                <?php  } elseif ($_SESSION['id_droits']== 3) { ?>
              <ul> <li><a href="index.php"><center>Accueil</center></a></li>
            <li><a href="profil.php">  Votre profil    <i><?php $_SESSION['login'] ?></i></a></li>
            <li><a href="admin.php"> espace modération </a></li>
            <li><a href="topics.php"> Topics  </a></li>

            <a href="index.php?deconnexion">
            <img src="https://img.icons8.com/fluent/48/000000/shutdown.png"/></a>
            <li style="float:right"><a class="active" href="#about">Faire une recherche</a></li>

          </ul>
        <?php  }
        } else { ?><ul>
          <li><a href="index.php">accueil</a></li>
          <li><a href="inscription.php">inscription</a></li>
          <li><a href="connexion.php">connexion</a></li>
          <li><a href="topics.php">Topics</a>
          </li>
          <li style="float:right"><a class="active" href="recherche.php">faire une recherche</li></a>
          </ul>
<?php  }   ?>


        <?php  if (isset($_GET['deconnexion'])) {
    unset($_SESSION['login']);
    //au bout de 2 secondes redirection vers la page d'accueil
    header("Refresh: 1; url=index.php");

    echo "<p>Vous avez été déconnecté</p><br><p>Redirection vers la page d'accueil...</p>";
}

        $message = "";
 ?>

  </body>
</html>
