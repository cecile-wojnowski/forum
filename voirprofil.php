<?php

include("includes/identifiant.php");
include("includes/header.php");

$id = $_GET['id'];
      //On récupère les infos du membre
      $query=$db->prepare('SELECT *
      FROM utilisateurs WHERE id=:id');
      $query->bindValue(':id',$id, PDO::PARAM_INT);
      $query->execute();
      $data=$query->fetch();

      //On affiche les infos sur le membre
      echo '<p><i>Vous êtes ici</i> : <a href="./index.php">Index du forum</a> -->
      profil de '.stripslashes(htmlspecialchars($data['login']));
      echo'<h1>Profil de '.stripslashes(htmlspecialchars($data['login'])).'</h1>';

      echo'<img src="./images/avatars/'.$data['avatar'].'"
      alt="Ce membre n a pas d avatar" />';

      echo'<p><strong>Adresse E-Mail : </strong>
      <a href="mailto:'.stripslashes($data['email']).'">
      '.stripslashes(htmlspecialchars($data['email'])).'</a><br />';



      echo'<strong>Site Web : </strong>
      <a href="'.stripslashes($data['website']).'">'.stripslashes(htmlspecialchars($data['membre_siteweb'])).'</a>
      <br /><br />';

      echo'Ce membre est inscrit depuis le
      <strong>'.date('d/m/Y',$data['membre_inscrit']).'</strong>
      et a posté <strong>'.$data['membre_post'].'</strong> messages
      <br /><br />';
      echo'<strong>Localisation : </strong>'.stripslashes(htmlspecialchars($data['localisation'])).'
      </p>';
      $query->CloseCursor();

?>
