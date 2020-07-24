
<?php
include("includes/identifiant.php");
include("includes/header.php");


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>



</style>
</head>
<body>

<center>
<h2>Chercher une conversation par son titre ou son contenu, tapez un mot !</h2>

<div class="recherche">

   <form method="POST" action="">
    <input type="text" name="recherche">
   <button type="submit"><i class="fa fa-search" name="submit"></i></button>
   </form>

   <?php

  $db_server = 'localhost';
  $db_name = 'forum';
  $db_user_login = 'root';
  $db_user_pass = '';

  // Ouvre une connexion au serveur MySQL
  $conn = mysqli_connect($db_server,$db_user_login, $db_user_pass, $db_name);

   // Récupère la recherche
   $recherche = isset($_POST['recherche']) ? $_POST['recherche'] : '';

   // la requete mysql
   $q = $conn->query(
   "SELECT * FROM conversations
    WHERE titre LIKE '%$recherche%'
    OR conversation LIKE '%$recherche%'
    LIMIT 10");

   // affichage du résultat
   while( $r = mysqli_fetch_array($q)){
   echo '<a href=conversations.php?id='.$r['id']. '>Résultat <a/>'.$r['titre'].', '.$r['conversation'].' <br />'

;
   }
?>
</center>
</div>


<center><h4> Vous ne savez pas quoi discuter ? Voici quelques idées de topics à visiter, cliquez pour en savoir plus</h4>


<button type="button" class="collapsible">Embauche</button>
<div class="content">
  <a href="topics.php?id=3"> Nouveau contrat de travail, négociation de salaire et des horaires, adaptation
  dans un environnement de travail, tout ce qu'il faut savoir à l'embauche. </a>
</div>
<button type="button" class="collapsible">Maladie et accident</button>
<div class="content">
  <a href="topics.php?id=2">Arrêt maladie, accident au travail suscitent beaucoup de question, particulièrement
  dans cette période de covid19, venez en parler. </a>
</div>
<button type="button" class="collapsible">Licenciement</button>
<div class="content">
  <a href="topis.php?id=3">La perte de son travail est une peur pour la majorité d'entre nous, comment faire et se défendre ? Cliquez ici pour
  en parler avec d'autres membres concernés.</a>
</div></center>


<script>

var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
<?php include('includes/footer.php')?>
</body>
</html>
