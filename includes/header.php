<?php
  include("identifiant.php");
  include("debut.php");
  session_start();
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
        <h2> Forum travail et salariés </h2>
<h3>Votre entraide vos droits</h3>      </div>

    </div>
    <?php
      $message = "";

      if (isset($_SESSION['login'])) {
        if ($_SESSION['id_droits']== 2)
        {
          ?> <ul> <li><a href="index.php"><center>Accueil</center></li></a>
          <li><a href="profil.php">  Votre profil <i> <?php $_SESSION['login'] ?></i></a></li>
          <li><a href="topics.php"> Topics  </a></li>
          <li><a href="creer_conversation.php"> Créer une conversation  </a></li>
          <li><a href="index.php?deconnexion"> Déconnexion</a></li>
          <li style="float:right"><a class="active" href="recherche.php">faire une recherche</li></a>

        </ul>
          <?php
        } elseif ($_SESSION['id_droits']== 3)
          { ?>
            <ul> <li><a href="index.php"> Accueil </a></li>
            <li><a href="profil.php">  Votre profil    <i><?php $_SESSION['login']?></i></a></li>
            <li><a href="topics.php"> Les topics  </a> </li>
            <li><a href="creer_conversation.php"> Créer une conversation  </a></li>
            <li><a href="index.php?deconnexion"><img src="https://img.icons8.com/fluent/48/000000/shutdown.png"/></a></li></ul>
            <?php  } elseif ($_SESSION['id_droits']== 4) { ?>
            <ul> <li><a href="index.php"><center> Accueil</center></a></li>
            <li><a href="profil.php">  Votre profil    <i><?php $_SESSION['login'] ?></i></a></li>
            <li><a href="moderation.php"> Espace modération </a></li>
            <li><a href="topics.php"> Topics  </a></li>

            <a href="index.php?deconnexion">
            <img src="https://img.icons8.com/fluent/48/000000/shutdown.png"/></a>
            <li style="float:right"><a class="active" href="recherche.php">faire une recherche</li></a>

          </ul>
        <?php  }
        } else { ?><ul>
          <li><a href="index.php"> Accueil</a></li>
          <li><a href="inscription.php"> Inscription</a></li>
          <li><a href="connexion.php"> Connexion</a></li>
          <li><a href="topics.php"> Topics</a>
          </li>
          <li style="float:right"><a class="active" href="recherche.php">faire une recherche</li></a>
          </ul>
<?php  }   ?>
