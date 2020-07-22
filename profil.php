<?php
include("includes/header.php");

if(!isset($_SESSION['login'])){
  header("Location:connexion.php");
}

# Affichage du message d'erreur
if (isset($_SESSION['message'])) : ?>
<div id="alert" class="<?php echo $_SESSION['message']['type']?>">
  <p><?php echo $_SESSION['message']["message"]?></p>
</div>
<?php unset($_SESSION["message"])?>
<?php endif;

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

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="form.css">
    <title></title>
  </head>
  <body>


<h1>Modifier son profil</h1>
<div class="container_profil">

<form name="modifier_profil" method="post" action="profil_update.php" enctype="multipart/form-data">
  <?php if(isset($_SESSION["message"]["message"])) {
    echo $_SESSION["message"]["message"];
  } ?>
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

    <p>(Taille max : 2 Mo)</p><br />
    <label><input type="checkbox" name="delete" value="Delete" />
    Supprimer l avatar</label>
    Avatar actuel :
    <img src="img/avatars/<?php echo $data['avatar']; ?>"
  alt="pas d avatar" height = "100px" width = "100px"/> <br />
    <label for="signature">Signature :</label>
    <textarea cols="40" rows="4" name="signature" id="signature" placeholder="<?php echo stripslashes(htmlspecialchars($data['signature'])) ?>"></textarea>
  </fieldset>

    <input type="submit" name="modifier_profil" value="Modifier son profil"/>
  <input type="hidden" id="sent" name="sent" value="1" />
</form>
</div>
<?php
include('includes/footer.php')?>

</body>
</html>
