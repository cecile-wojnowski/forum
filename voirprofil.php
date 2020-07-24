<?php

include("includes/identifiant.php");
include("includes/header.php");
$membre = $_GET['m'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title></title>
  </head>
  <body>

  </body>
</html>
<div class="profil">

<?php

//On récupère les infos du membre
    $query=$db->prepare('SELECT *
    FROM utilisateurs WHERE id=:id');
   $query->bindValue(':id',$membre, PDO::PARAM_INT);
    $query->execute();
    while($data=$query->fetch()){
    //On affiche les infos sur le membre
    echo'<h1>Profil de '.stripslashes(htmlspecialchars($data['login'])).'</h1>';

    echo'<img src="img/'.$data['avatar'].'"
        alt="Ce membre n a pas d avatar" style="width:15%"/>';

    echo'<p><strong>Adresse E-Mail : </strong>
    <a href="mailto:'.stripslashes($data['email']).'">
    '.stripslashes(htmlspecialchars($data['email'])).'</a><br />';

    echo'<strong>Site Web : </strong>
    <a href="'.stripslashes($data['website']).'">'.stripslashes(htmlspecialchars($data['website'])).'</a>
    <br /><br />';

    echo'Ce membre est inscrit depuis le
    <strong>'.date('d/m/Y',$data['date_inscription']).'</strong>
    et sa signature est : <strong>'.$data['signature'].'</strong>
    <br /><br />';
    echo'<strong>Localisation : </strong>'.stripslashes(htmlspecialchars($data['localisation'])).'
    </p>';
  }

?>

<a href="annuaire.php">Voir tout les utilisateurs du site</a>
</div>


<?php include('includes/footer.php') ?>
