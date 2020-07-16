<?php
# Inutile ?
function verif_auth($auth_necessaire)
{
  $level=(isset($_SESSION['level']))?$_SESSION['level']:1;
  return ($auth_necessaire <= intval($level));
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
   }else{
     return false;
  }
}
?>
