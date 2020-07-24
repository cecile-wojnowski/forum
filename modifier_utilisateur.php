<?php
include("includes/identifiant.php");
include("includes/header.php");

# Si le formulaire a déjà été rempli, on fait la modification
if (isset($_POST['modification']))
{
  $id = $_GET["id"];
  $id_droits = $_POST['id_droits'];
  $login = $_POST['login'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $localisation = $_POST['localisation'];
  $site_web = $_POST['website'];
  $signature = $_POST['signature'];

  $req = $db->prepare('UPDATE utilisateurs
    SET id_droits = :id_droits, login = :login, email=:email, password=:password,
    localisation =:localisation, website =:website, signature = :signature
    WHERE id = :id');
  $req->execute(array(
    ':id_droits' => $id_droits,
    ':id' => $id,
    ':login' => $login,
    ':email'=>$email,
    ':password' =>$password,
    ':localisation' =>$localisation,
    ':website' => $site_web,
    ':signature' => $signature));

  $_SESSION["message"] = 'Modification enregistrée';
  header("Location:moderation.php");

}

# Si l'utilisateur n'est pas connecté, il ne peut pas modifier un autre
if (!isset($_SESSION["id"])) {
  $_SESSION["message"] = "Seul un utilisateur connecté peut modifier un utilisateur";
  header("Location:index.php");
} elseif($_SESSION["id_droits"] != 4) {
  $_SESSION["message"] = "Seuls les administrateurs peuvent modifier des comptes";
  header("Location:index.php");
} elseif(isset($_GET["id"])) {
  $id = $_GET['id'];

  $pdoselect = $db->prepare('SELECT * FROM utilisateurs WHERE id = :id');
  $pdoselect ->bindValue(':id', $id, PDO::PARAM_INT);
  $executepdo= $pdoselect->execute();
  $info= $pdoselect->fetch();

  ?>

  <form name="modification" action="modifier_utilisateur.php?id=<?php echo $id ?>" method="POST">

    <table border="0" align="center" cellspacing="2" cellpadding="2">
  		<tr align="center">
  			<td> Login </td>
  					<td><input type="text" name="login" value="<?php echo $info['login']; ?>"></td>
  				</tr>
  				<tr align="center">
  					<td> E-mail </td>
  					<td><input type="text" name="email"value="<?php echo $info['email'] ; ?>"></td>
  				</tr>
          <tr align="center">
  					<td> Mot de passe </td>
  					<td><input type="password" name="password" value="<?php echo $info['password'] ?>"></td>
  				</tr>
          <tr align="center">
  					<td> Date d'inscription </td>
  					<td><input type="date" name="date" value="<?php echo $info['date_inscription'] ?>"></td>
  				</tr>
          <tr align="center">
  					<td> Id_droits </td>
  					<td>
              <select name="id_droits" id="id_droits">
                <option value="2"> Utilisateur </option>
                <option value="3"> Modérateur </option>
                <option value="4"> Admin </option>
                <option value="5"> Banni </option>
              </select>
            </td>
          </tr>
          <tr align="center">
  					<td> Localisation </td>
  					<td><input type="text" name="localisation" value="<?php echo $info['localisation'] ?>"></td>
  				</tr>
          <tr align="center">
  					<td> Site web </td>
  					<td><input type="text" name="website" value="<?php echo $info['website'] ?>"></td>
  				</tr>
          <tr align="center">
  					<td> Signature</td>
  					<td><input type="text" name="signature" value="<?php echo $info['signature'] ?>"></td>
  				</tr>


          <td><input name="modification" type="submit" value="Modifier le profil"></td>
        </table>
      </form>
<?php
} else {
  header("Location:index.php");
}
include("includes/footer.php");
?>
