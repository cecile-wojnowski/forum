<?php
$titre="Connexion";
include("includes/identifiant.php");
include("includes/header.php");
echo '<p><i>Vous êtes ici</i> : <a href="./index.php">Index du forum</a> --> Connexion';

?>


<?php

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

  </body>
</html>

<?php
if (isset($_SESSION['id'])) {
echo "vous êtes déjà connecté, <a href='deconnexion.php' me déconnecter </a> ou <a href='profil.php'> voir mon profil </a> ";
} else{
if (!isset($_POST['login'])) { //On est dans la page de formulaire
?>  '<form method="post" action="connexion.php">

  <div class="container">
        <h2 >Bon retour parmi nous !</h2>
        <h4 >Connectez-vous avec votre login et mot de passe</h4>
      <div class="form">
<label for="">Login</label>        <input type="text" class="form-field animation a3" placeholder="login" name="login" id="pseudo">
      <label for="">Password</label>  <input type="password" class="form-field animation a4" placeholder="Password" name="password" id="password">
        <p class="animation a5">	<a href="./inscription.php">Pas encore inscrit ?</a></p>
        <div class="button"> <button type="submit" value="Connexion">LOGIN</button></div>
      </div>
    </div>
	</body>
	</html>';

<?php } else {
    $message='';
    if (empty($_POST['login']) || empty($_POST['password'])) { //Oublie d'un champ
        $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="./connexion.php">ici</a> pour revenir</p>';
    } else { //On check le mot de passe
        $query=$db->prepare('SELECT password, id, id_droits, login
        FROM utilisateurs WHERE login = :login');
        $query->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
        $query->execute();

        $data=$query->fetch();
        if ($data['password'] == md5($_POST['password'])) { // Acces OK !
            $_SESSION['login'] = $data['login'];
            $_SESSION['id_droits'] = $data['id_droits'];
            $_SESSION['id'] = $data['id'];
            $message = '<p>Bienvenue '.$data['login'].'votre id_droits est'.$data['id_droits'].',
			vous êtes maintenant connecté!</p>
			<p>Cliquez <a href="./index.php">ici</a>
			pour revenir à la page d accueil</p> et ici pour <a href="profil.php"> voir votre profil </a';
        } else { // Acces pas OK !
            $message = '<p>Une erreur s\'est produite
	    pendant votre identification.<br /> Le mot de passe ou le pseudo
            entré n\'est pas correcte.</p>';
        }
        $query->CloseCursor();
    }
    echo $message.'</div></body></html>';
}
}

?>

<?php include("includes/footer.php");
 ?>
