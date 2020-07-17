<?php
# Inutile ?
function verif_auth($auth_necessaire)
{
  $level=(isset($_SESSION['level']))?$_SESSION['level']:1;
  return ($auth_necessaire <= intval($level));
}

# Upload un fichier d'avatar et renvoie son nom
function move_avatar($avatar)
{
    $extension_upload = strtolower(substr(  strrchr($avatar['name'], '.')  ,1));
    $name = time();
    $nomavatar = str_replace(' ','',$name).".".$extension_upload;
    $name = "../images/avatars/".str_replace(' ','',$name).".".$extension_upload;
    move_uploaded_file($avatar['tmp_name'],$name);
    return $nomavatar;
}

# Permet d'afficher des messages d'erreur spécifiques sur Profil
function erreur_profil($db)
{
  $erreur = null;
  $id=$_SESSION['id'];
  $query=$db->prepare('SELECT * FROM utilisateurs WHERE id=:id');
  $query->bindValue(':id',$id,PDO::PARAM_INT);
  $query->execute();
  $data=$query->fetch();

  $pseudo = $_POST['pseudo'];
  $signature = $_POST['signature'];
  $email = $_POST['email'];
  $website = $_POST['website'];
  $localisation = $_POST['localisation'];
  $pass = md5($_POST['password']);
  $confirm = md5($_POST['confirm']);

   if(isset($_POST['modifier_profil']) AND ($_POST['password'] != $_POST['confirm']))
   {
     $_SESSION["message"]["message"]="Votre mot de passe et votre confirmation diffèrent ou sont vides.";
     $_SESSION["message"]['type']="danger";
     return true;

   }elseif(strtolower($data['email']) != strtolower($email))
   {
     $_SESSION["message"] =  "Votre adresse email est déjà utilisé par un membre.";
     $_SESSION["message"]['type']="danger";
     return true;

   }elseif (isset($_POST['modifier_profil']) AND !preg_match("#^[a-z0-9A-Z._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
   {
      $_SESSION["message"]['message']= "Votre nouvelle adresse E-Mail n'a pas un format valide.";
      $_SESSION["message"]['type']="danger";
       return true;

   }elseif (strlen($signature) > 200)
   {
      $_SESSION["message"]["message"]= "Votre nouvelle signature est trop longue.";
      $_SESSION["message"]['type']="danger";
     return true;
   }elseif (!empty($_FILES['avatar']['size']))
   {
      //On définit les variables :
      $maxsize = 30072; //Poid de l'image
      $maxwidth = 100; //Largeur de l'image
      $maxheight = 100; //Longueur de l'image
      //Liste des extensions valides
      $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' );

      if ($_FILES['avatar']['size'] > $maxsize)
      {
        $avatar_erreur1 = "Le fichier est trop gros :
        (<strong>".$_FILES['avatar']['size']." Octets</strong>
        contre <strong>".$maxsize." Octets</strong>)";
      }
       $image_sizes = getimagesize($_FILES['avatar']['tmp_name']);
       if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
       {
       $avatar_erreur2 = "Image trop large ou trop longue :
       (<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre
       <strong>".$maxwidth."x".$maxheight."</strong>)";
       }

       $extension_upload = strtolower(substr(  strrchr($_FILES['avatar']['name'], '.')  ,1));
       if (!in_array($extension_upload,$extensions_valides) )
       {
         $avatar_erreur3 = "Extension de l'avatar incorrecte";
       }
    }else{
     return false;
    }
  }
?>
