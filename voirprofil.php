<?php

include("includes/identifiant.php");
include("includes/header.php");
$membre = isset($_GET['m'])?(int) $_GET['m']:'';

//On récupère les infos du membre
    $query=$db->prepare('SELECT *
    FROM utilisateurs WHERE id=:id');
    $query->execute();
    while($data=$query->fetch()){
    //On affiche les infos sur le membre
    echo '<p><i>Vous êtes ici</i> : <a href="./index.php">Index du forum</a> -->
    profil de '.stripslashes(htmlspecialchars($data['login']));
    echo'<h1>Profil de '.stripslashes(htmlspecialchars($data['login'])).'</h1>';

    echo'<img src="./images/avatars/'.$data['membre_avatar'].'"
    alt="Ce membre n a pas d avatar" />';

    echo'<p><strong>Adresse E-Mail : </strong>
    <a href="mailto:'.stripslashes($data['membre_email']).'">
    '.stripslashes(htmlspecialchars($data['membre_email'])).'</a><br />';

    echo'<strong>MSN Messenger : </strong>'.stripslashes(htmlspecialchars($data['membre_msn'])).'<br />';

    echo'<strong>Site Web : </strong>
    <a href="'.stripslashes($data['membre_siteweb']).'">'.stripslashes(htmlspecialchars($data['membre_siteweb'])).'</a>
    <br /><br />';

    echo'Ce membre est inscrit depuis le
    <strong>'.date('d/m/Y',$data['membre_inscrit']).'</strong>
    et a posté <strong>'.$data['membre_post'].'</strong> messages
    <br /><br />';
    echo'<strong>Localisation : </strong>'.stripslashes(htmlspecialchars($data['membre_localisation'])).'
    </p>';
  }

?>
