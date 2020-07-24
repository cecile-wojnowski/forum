<?php
session_start();
include ("includes/identifiant.php");
include ("includes/functions.php");

if (erreur_profil($db) == false)
{
    if (isset($_POST['modifier_profil']))
    {

        $pseudo = $_POST['pseudo'];
        $signature = $_POST['signature'];
        $email = $_POST['email'];
        $website = $_POST['website'];
        $localisation = $_POST['localisation'];
        $pass = $_POST['password'];
        $confirm = $_POST['confirm'];
        $passcrypt = password_hash($pass, PASSWORD_BCRYPT);

        $nomavatar = $_POST['avatar'];

        $id = $_SESSION['id'];

        $query = $db->prepare('UPDATE utilisateurs
   SET login = :pseudo, password = :password, email=:email, website=:website,
   signature=:signature, localisation=:localisation, avatar =:avatar
   WHERE id=:id');
        $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->bindValue(':password', $passcrypt, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':website', $website, PDO::PARAM_STR);
        $query->bindValue(':signature', $signature, PDO::PARAM_STR);
        $query->bindValue(':localisation', $localisation, PDO::PARAM_STR);
        $query->bindValue(':avatar', $nomavatar, PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }
    if (!empty($_FILES['avatar']['size']))
    {
        # Transporte l'avatar et retourne son nom
        $nomavatar = move_avatar($_FILES['avatar']);
        $query = $db->prepare('UPDATE utilisateurs SET avatar = :avatar
      WHERE id = :id');
        $query->bindValue(':avatar', $nomavatar, PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor();

        if (isset($_POST['delete']))
        {
            $query = $db->prepare('UPDATE forum_membres SET membre_avatar=0 WHERE membre_id = :id');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor();
        }
    }
}
header("Location:profil.php");
?>
