<?php
  $titre="Connexion";
  include("includes/header.php");
  echo '<p><i>Vous êtes ici</i> : <a href="./index.php">Index du forum</a> --> Connexion';
  echo '<h1>Connexion</h1>';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="style.css">
    <title></title>
  </head>
  <body>

<?php

  if (isset($_SESSION['id'])) {
  echo "Vous êtes déjà connecté, <a href='deconnexion.php' me déconnecter </a> ou <a href='profil.php'> voir mon profil </a> ";
  } else{
    if (!isset($_POST['login']))
    {

    ?>
    <form method="POST" action="connexion.php">
      <div class="container">
        <h2>Connectez-vous avec votre login et mot de passe</h2>
        <div class="form">
          <label forb="">Login</label>
          <input type="text" class="form-field animation a3" placeholder="login" name="login" id="pseudo">
          <label for="">Password</label>
          <input type="password" class="form-field animation a4" placeholder="Password" name="password" id="password">

          <p class="animation a5">	<a href="./inscription.php">Pas encore inscrit ?</a></p>
          <div class="button">
            <button type="submit" value="Connexion"> Se connecter </button>
          </div>
        </div>
      </div>

    <?php

  }else{ # Si $_POST['login'] est rempli
      $message='';
      if (empty($_POST['login']) || empty($_POST['password']))
      { //Oubli d'un champ
        $message = '<p>une erreur s\'est produite pendant votre identification.
      	Vous devez remplir tous les champs. </p>
      	<p>Cliquez <a href="./connexion.php">ici</a> pour revenir</p>';
      }
      else
      { # On cherche s'il y a un user ayant un login identique à celui entré dans le formulaire
        $query=$db->prepare('SELECT password, id, id_droits, login FROM utilisateurs WHERE login = :login');
        $query->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
        $query->execute();

          if ($query->rowCount() == 1 ) # S'il y a au moins un résultat, on va chercher les infos dans la table
         {
          $mdp = $_POST['password'];
          $data=$query->fetch();
          $mdpbdd = $data['password'];
            # Si le mot de passe entré correspond à celui en bdd, on permet la connexion
            if(password_verify($mdp, $mdpbdd))
            {
              if($data['id_droits'] == 5){
                echo "Vous avez été banni, vous ne pouvez donc pas vous connecter.";
              }else{
              # On stocke dans des variables de session les données récupérées dans la table
              $_SESSION['login'] = $data['login'];
              $_SESSION['id_droits'] = $data['id_droits'];
              $_SESSION['id'] = $data['id'];

              $message = '<p>Bienvenue '.$data['login'].'votre id_droits est '.$data['id_droits'].',
                    vous êtes maintenant connecté!</p>
                    <p>Cliquez <a href="./index.php">ici</a>
                    pour revenir à la page d accueil</p> et ici pour <a href="profil.php"> voir votre profil </a>';
            }
          }else {
            $message = '<p>Une erreur s\'est produite pendant votre identification.<br /> Le mot de passe ou le pseudo
            entré n\'est pas correct.</p>';
          }
        }
      }
        $query->CloseCursor();
    }
    echo $message.'</div></body></html>';
}

 include("includes/footer.php");
 ?>
</body>
</html>
