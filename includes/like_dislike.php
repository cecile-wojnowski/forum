<?php
 echo "Voici l'id message : " . $id_message;
  # Permettra l'affichage du nombre de like :
  $query =  $db->prepare("SELECT COUNT(*) FROM like_dislike
    WHERE like_dislike = 1 AND id_message = '$id_message'");
  $query->execute();
  $nb_like = $query->fetchColumn();
  # Permettra l'affichage du nombre de dislike :
  $query =  $db->prepare("SELECT COUNT(*) FROM like_dislike
    WHERE like_dislike = 0 AND id_message = '$id_message'");
  $query->execute();
  $nb_dislike = $query->fetchColumn();


  # Insertion d'un like si l'utilisateur n'a pas déjà voté
  if (isset($_POST['like']))
  {
    $id_utilisateur = $_SESSION['id'];
    $query = $db->prepare("SELECT COUNT(*) FROM like_dislike
    WHERE id_utilisateur = '$id_utilisateur' AND like_dislike = 1 AND id_message='$id_message'");
    $query->execute();
    $result = $query->fetchColumn();

    if($result == 0)
    {
      if(empty($_SESSION['id']))
      {
        echo "vous devez vous connectez pour voter.";
      }else
      {
        $id_utilisateur = $_SESSION['id'];
        $like_dislike = true;

        $req = $db->prepare("INSERT INTO like_dislike (id_message, id_utilisateur, like_dislike)
        VALUES('$id_message', '$id_utilisateur', '$like_dislike')");
        $req->execute();

        echo "Votre vote a été pris en compte";
      }
    } else{
      echo "Vous avez déjà voté.";
    }
  }

  # Insertion d'un dislike si l'utilisateur n'a pas déjà voté
  if (isset($_POST['dislike']))
  {
    $id_utilisateur = $_SESSION['id'];
    $query = $db->prepare("SELECT COUNT(*) FROM like_dislike
    WHERE id_utilisateur = '$id_utilisateur' AND like_dislike = 0 AND id_message='$id_message'");
    $query->execute();
    $result = $query->fetchColumn();

    if($result == 0)
    {
      if(empty($_SESSION['id']))
      {
        echo "Vous devez vous connectez pour voter.";
      }else
      {
        $id_utilisateur = $_SESSION['id'];
        $like_dislike = false;
        echo "Encore l'id_message : " . $id_message;

        $req = $db->prepare("INSERT INTO like_dislike (id_message, id_utilisateur, like_dislike)
        VALUES('$id_message', '$id_utilisateur', '$like_dislike')");
        $req->execute();

        echo "Votre vote a été pris en compte";
      }
    }else{
      echo "Vous avez déjà voté.";
    }
  }

?>
