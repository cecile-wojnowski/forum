<?php
	session_start();
	$titre="Enregistrement";

	include("includes/header.php");
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
	<head>
		<link rel="stylesheet" href="form.css">
		<title></title>
	</head>
	<body>
		<?php
			if (empty($_POST['pseudo'])) // Si la variable est vide, on peut considérer qu'on est sur la page de formulaire
			{
				echo '<h1>Inscription</h1>';
				echo '<div class="container"><form method="post" action="inscription.php" enctype="multipart/form-data">
				<fieldset><legend>Identifiants</legend>
				<label for="pseudo">* Pseudo :</label>  <input name="pseudo" type="text" id="pseudo" /> (le pseudo doit contenir entre 3 et 15 caractères)<br />
				<label for="password">* Mot de Passe :</label><input type="password" name="password" id="password" /><br />
				<label for="confirm">* Confirmer le mot de passe :</label><input type="password" name="confirm" id="confirm" />
				</fieldset>
				<fieldset><legend>Contacts</legend>
				<label for="email">* Votre adresse Mail :</label><input type="text" name="email" id="email" /><br />
				<label for="website">Votre site web :</label><input type="text" name="website" id="website" />
				</fieldset>
				<fieldset><legend>Informations supplémentaires</legend>
				<label for="localisation">Localisation :</label><input type="text" name="localisation" id="localisation" />
				</fieldset>
				<fieldset><legend>Profil sur le forum</legend>
				<label for="avatar">Choisissez votre avatar :</label><input type="file" name="avatar" id="avatar" />(Taille max : 10Ko<br />
				<label for="signature">Signature :</label><textarea cols="40" rows="4" name="signature" id="signature">La signature est limitée à 200 caractères</textarea>
				</fieldset>
				<p>Les champs précédés d\'un * sont obligatoires.</p>
				<p><input type="submit" value="S\'inscrire" /></p></form>
				</div>
				</body>
				</html>';
		?>
		<?php
			} //Fin de la partie formulaire
			else // Si le formulaire est rempli, on est dans le cas traitement
			{
		    $pseudo_erreur1 = NULL;
		    $pseudo_erreur2 = NULL;
		    $mdp_erreur = NULL;
		    $email_erreur1 = NULL;
		    $email_erreur2 = NULL;
		    $signature_erreur = NULL;
		    $avatar_erreur = NULL;
		    $avatar_erreur1 = NULL;
		    $avatar_erreur2 = NULL;
		    $avatar_erreur3 = NULL;

    		//On récupère les variables
		    $temps = time();
		    $pseudo = $_POST['pseudo'];
		    $signature = $_POST['signature'];
		    $email = $_POST['email'];
		    $website = $_POST['website'];
		    $localisation = $_POST['localisation'];
		    $pass = md5($_POST['password']);
		    $confirm = md5($_POST['confirm']);

				$id_droits=2; # Toute inscription donne les droits "inscrit"

		    //Vérification du pseudo
		    $query=$db->prepare('SELECT COUNT(*) AS nbr FROM utilisateurs WHERE login =:login');
		    $query->bindValue(':login', $pseudo, PDO::PARAM_STR);
		    $query->execute();
		    $pseudo_free=($query->fetchColumn() == 0) ? 1 : 0;
		    $query->CloseCursor();
				$i = 0; # Permettra le comptage des erreurs
		    if(!$pseudo_free)
    		{
	        $pseudo_erreur1 = "Votre pseudo est déjà utilisé par un membre.";
	        $i++;
    		}
		    if (strlen($pseudo) < 3 || strlen($pseudo) > 15)
		    {
		        $pseudo_erreur2 = "Votre pseudo est soit trop grand, soit trop petit.";
		        $i++;
		    }
		   	//Vérification du mdp
		    if ($pass != $confirm || empty($confirm) || empty($pass))
		    {
		        $mdp_erreur = "Votre mot de passe et votre confirmation diffèrent, ou sont vides.";
		        $i++;
		    }

    	//Vérification de l'adresse email

    	//Il faut que l'adresse email n'ait jamais été utilisée
	    $query=$db->prepare('SELECT COUNT(*) AS nbr FROM utilisateurs WHERE email =:email');
	    $query->bindValue(':email', $email, PDO::PARAM_STR);
	    $query->execute();
	    $mail_free=($query->fetchColumn()==0)?1:0;
	    $query->CloseCursor();

	    if(!$mail_free)
	    {
	        $email_erreur1 = "Votre adresse email est déjà utilisée par un membre.";
	        $i++;
	    }
	    //On vérifie la forme maintenant
	    if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty($email))
	    {
	        $email_erreur2 = "Votre adresse e-mail n'a pas un format valide.";
	        $i++;
	    }
	    //Vérification de la signature
	    if (strlen($signature) > 200)
	    {
	        $signature_erreur = "Votre signature est trop longue.";
	        $i++;
	    }

	    //Vérification de l'avatar :
	    if (!empty($_FILES['avatar']['size']))
	    {
	        //On définit les variables :
	        $maxsize = 10024; //Poid de l'image
	        $maxwidth = 100; //Largeur de l'image
	        $maxheight = 100; //Longueur de l'image
	        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' ); //Liste des extensions valides

	        if ($_FILES['avatar']['error'] > 0)
	        {
	                $avatar_erreur = "Erreur lors du transfert de l'avatar : ";
	        }
	        if ($_FILES['avatar']['size'] > $maxsize)
	        {
	                $i++;
	                $avatar_erreur1 = "Le fichier est trop gros : (<strong>".$_FILES['avatar']['size']." Octets</strong>    contre <strong>".$maxsize." Octets</strong>)";
	        }

	        $image_sizes = getimagesize($_FILES['avatar']['tmp_name']);
	        if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
	        {
	                $i++;
	                $avatar_erreur2 = "Image trop large ou trop longue :
	                (<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre <strong>".$maxwidth."x".$maxheight."</strong>)";
	        }

	        $extension_upload = strtolower(substr(  strrchr($_FILES['avatar']['name'], '.')  ,1));
	        if (!in_array($extension_upload,$extensions_valides) )
	        {
	                $i++;
	                $avatar_erreur3 = "Extension de l'avatar incorrecte";
	        }
	    }

   		if ($i==0) # Si aucune erreur n'est rencontrée, un message de confirmation apparaît
   			{
				 	echo'<h1>Inscription terminée</h1>';
		      echo'<p>Bienvenue '.stripslashes(htmlspecialchars($_POST['pseudo'])).' vous êtes maintenant inscrit sur le forum</p>
					<p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d accueil</p>';

		        //La ligne suivante sera commentée plus bas
					$nomavatar=(!empty($_FILES['avatar']['size']))?move_avatar($_FILES['avatar']):'';

		      $query=$db->prepare('INSERT INTO utilisateurs( `login`, `email`, `password`, `date_inscription`, `id_droits`, `localisation`, `website`, `signature`, `avatar`)
		      VALUES (:login, :email, :pass, :temps, :id_droits, :localisation, :website, :signature, :avatar)');
					$query->bindValue(':login', $pseudo, PDO::PARAM_STR);
					$query->bindValue(':email', $email, PDO::PARAM_STR);
					$query->bindValue(':pass', $pass, PDO::PARAM_STR);
					$query->bindValue(':temps', $temps, PDO::PARAM_INT);
					$query->bindValue(':id_droits', $id_droits, PDO::PARAM_STR);
					$query->bindValue(':localisation', $localisation, PDO::PARAM_STR);
					$query->bindValue(':website', $website, PDO::PARAM_STR);
					$query->bindValue(':signature', $signature, PDO::PARAM_STR);
					$query->bindValue(':avatar', $nomavatar, PDO::PARAM_STR);
					$query->execute();

			//Et on définit les variables de sessions
		        $_SESSION['login'] = $pseudo;
		        $_SESSION['id'] = $db->lastInsertId(); ;
		        $_SESSION['level'] = 2;
						$_SESSION['id_droits'] = 1;

		        $query->CloseCursor();
		    }
		    else
		    {
		        echo'<h1>Inscription interrompue</h1>';
		        echo'<p>Une ou plusieurs erreurs se sont produites pendant l\'incription.</p>';
		        echo'<p>'.$i.' erreur(s)</p>';
		        echo'<p>'.$pseudo_erreur1.'</p>';
		        echo'<p>'.$pseudo_erreur2.'</p>';
		        echo'<p>'.$mdp_erreur.'</p>';
		        echo'<p>'.$email_erreur1.'</p>';
		        echo'<p>'.$email_erreur2.'</p>';
		        echo'<p>'.$signature_erreur.'</p>';
		        echo'<p>'.$avatar_erreur.'</p>';
		        echo'<p>'.$avatar_erreur1.'</p>';
		        echo'<p>'.$avatar_erreur2.'</p>';
		        echo'<p>'.$avatar_erreur3.'</p>';

		        echo'<p>Cliquez <a href="./inscription.php">ici</a> pour recommencer</p>';
    		}
			}
?>
</div>
</body>
</html>
<?php
function move_avatar($avatar)
{
    $extension_upload = strtolower(substr(  strrchr($avatar['name'], '.')  ,1));
    $name = time();
    $nomavatar = str_replace(' ','',$name).".".$extension_upload;
    $name = "images/avatars/".str_replace(' ','',$name).".".$extension_upload;
    move_uploaded_file($avatar['tmp_name'],$name);
    return $nomavatar;
}

include("includes/footer.php");
?>
</body>
</html>
