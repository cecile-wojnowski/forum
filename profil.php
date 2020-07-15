<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['login'])){
  header("Location:connexion.php");
}

$id=$_SESSION['id'];
$query=$db->prepare('SELECT * FROM utilisateurs WHERE id=:id');
$query->bindValue(':id',$id,PDO::PARAM_INT);
$query->execute();
$data=$query->fetch();

# Stockage des données de la table dans des variables
$pass=$data["password"];
$email=$data["email"];
$signature=$data["signature"];
$localisation=$data["localisation"];
$website=$data["website"];
?>
<p><i>Vous êtes ici</i> : <a href="./index.php">Index du forum</a> --> Modification du profil; </p>

<h1>Modifier son profil</h1>
<form name="modifier_profil" method="post" action="profil.php" enctype="multipart/form-data">
  <fieldset><legend>Identifiants</legend>
    <label for="pseudo"> Pseudo : </label>
    <input type ="text" name="pseudo" id="pseudo" value="<?php echo stripslashes(htmlspecialchars($data['login']))?>">

    <label for="password">Nouveau mot de Passe :</label>
    <input type="password" name="password" id="password" /><br />
    <label for="confirm">Confirmer le mot de passe :</label>
    <input type="password" name="confirm" id="confirm"  />
  </fieldset>

  <fieldset><legend>Contacts</legend>
    <label for="email">Votre adresse e-mail :</label>
    <input type="text" name="email" id="email" value="<?php echo stripslashes(htmlspecialchars($data['email'])) ?>" /><br />

    <label for="website">Votre site web :</label>
    <input type="text" name="website" id="website" value="<?php echo stripslashes(htmlspecialchars($data['website'])) ?>" /><br />
  </fieldset>

  <fieldset><legend>Informations supplémentaires</legend>
    <label for="localisation">Localisation :</label>
    <input type="text" name="localisation" id="localisation" value="<?php echo stripslashes(htmlspecialchars($data['localisation'])) ?>" /><br />
  </fieldset>

  <fieldset><legend>Profil sur le forum</legend>
    <label for="avatar">Changer votre avatar :</label>
    <input type="file" name="avatar" id="avatar" />
    (Taille max : 10 ko)<br /><br />
    <label><input type="checkbox" name="delete" value="Delete" />
    Supprimer l avatar</label>
    Avatar actuel :
    <img src="./images/avatars/ <?php $data['avatar'] ?>"
    alt="pas d avatar" /> <br />
    <label for="signature">Signature :</label>
    <textarea cols="40" rows="4" name="signature" id="signature"> <?php stripslashes(htmlspecialchars($data['signature'])) ?></textarea>
  </fieldset>

  <div class="button">
  <input type="submit" name="modifier_profil" value="Modifier son profil"/></div>
  <input type="hidden" id="sent" name="sent" value="1" />
</form>

<?php

# $temps = time();

/*erreur_profil() = false AND*/
 if(isset($_POST['modifier_profil'])){
   $pseudo = $_POST['pseudo'];
   $signature = $_POST['signature'];
   $email = $_POST['email'];
   $website = $_POST['website'];
   $localisation = $_POST['localisation'];
   $pass = md5($_POST['password']);
   $confirm = md5($_POST['confirm']);

  $query=$db->prepare('UPDATE utilisateurs
  SET login = :pseudo, password = :password, email=:email, website=:website,
  signature=:signature, localisation=:localisation
  WHERE id=:id');
  $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
  $query->bindValue(':password',$pass,PDO::PARAM_STR);
  $query->bindValue(':email',$email,PDO::PARAM_STR);
  $query->bindValue(':website',$website,PDO::PARAM_STR);
  $query->bindValue(':signature',$signature,PDO::PARAM_STR);
  $query->bindValue(':localisation',$localisation,PDO::PARAM_STR);
  $query->bindValue(':id',$id,PDO::PARAM_INT);
  $query->execute();
  header("Refresh");
}

  # $query->CloseCursor();

    //Vérification de l'avatar

    /*if (!empty($_FILES['avatar']['size']))
    {
        //On définit les variables :
        $maxsize = 30072; //Poid de l'image
        $maxwidth = 100; //Largeur de l'image
        $maxheight = 100; //Longueur de l'image
        //Liste des extensions valides
        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' );

        if ($_FILES['avatar']['error'] > 0)
        {
        $avatar_erreur = "Erreur lors du tranfsert de l'avatar : ";
        }
        if ($_FILES['avatar']['size'] > $maxsize)
        {
        $i++;
        $avatar_erreur1 = "Le fichier est trop gros :
        (<strong>".$_FILES['avatar']['size']." Octets</strong>
        contre <strong>".$maxsize." Octets</strong>)";
        }

        $image_sizes = getimagesize($_FILES['avatar']['tmp_name']);
        if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
        {
        $i++;
        $avatar_erreur2 = "Image trop large ou trop longue :
        (<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre
        <strong>".$maxwidth."x".$maxheight."</strong>)";
        }

        $extension_upload = strtolower(substr(  strrchr($_FILES['avatar']['name'], '.')  ,1));
        if (!in_array($extension_upload,$extensions_valides) )
        {
          $i++;
          $avatar_erreur3 = "Extension de l'avatar incorrecte";
        }
    } */

?>

<?php
/*
    echo '<p><i>Vous êtes ici</i> : <a href="./index.php">Index du forum</a> --> Modification du profil';
    echo '<h1>Modification d\'un profil</h1>';


    if ($i == 0) // Si $i est vide, il n'y a pas d'erreur
    {
        if (!empty($_FILES['avatar']['size']))
        {
                $nomavatar=move_avatar($_FILES['avatar']);
                $query=$db->prepare('UPDATE forum_membres
                SET membre_avatar = :avatar
                WHERE membre_id = :id');
                $query->bindValue(':avatar',$nomavatar,PDO::PARAM_STR);
                $query->bindValue(':id',$id,PDO::PARAM_INT);
                $query->execute();
                $query->CloseCursor();
        }
        if (isset($_POST['delete']))
        {
                $query=$db->prepare('UPDATE forum_membres
		                SET membre_avatar=0 WHERE membre_id = :id');
                $query->bindValue(':id',$id,PDO::PARAM_INT);
                $query->execute();
                $query->CloseCursor();
        }
  }
    echo'<p>Cliquez <a href="./index.php">ici</a>
    pour revenir à la page d accueil</p>';
  */
?>
</div>
</body>
</html>
