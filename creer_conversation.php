
 <?php

 include("includes/identifiant.php");
 include("includes/header.php");
 include("./includes/function.php");




?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="form.css">
  </head>
  <body>

  </body>
</html>

<?php
 if($_SERVER['REQUEST_METHOD'] != 'POST')
 {
   if (isset($_SESSION['login'])){
     ?>
<div class="container">

      <form method='post' action=''>
         Titre de la conversation: <input type='text' name='cat_name' />
         Contenu de la conversation: <textarea name='conversation' /></textarea>
         <label for="">Topic</label>
         <select name="topic">
           <?php   $reponse = $db->query('SELECT * FROM topics');

              // On affiche chaque entrée une à une
              while ($donnees = $reponse->fetch()) {
                  ?>
                  <strong>catégorie</strong> : <?php echo"<option value = '". $donnees["id"]."'>". $donnees['topic']."</option>";
              } ?>
                  <br />

            </select>


         <input type='submit' name='poster_conversation' value='Poster la conversation' />
      </form>
    </div>


 <?php

if (isset($_POST['poster_conversation'])) {
            $titre=$_POST['titre'];
            $conversation=$_POST['conversation'];
            $conversation = str_replace("'", "\'", $article); # Permet l'affichage des guillemets
            $id_utilisateur=$_SESSION['id'];
            $id_topic=$_POST['topic'];

            $sql= "INSERT INTO `conversations`( `titre`, `conversation`, `id_topic`, `titre`)
            VALUES ('$article',$id_utilisateur, $id_categorie,NOW(),'$titre')";

            $resultat = mysqli_query($mysqli, $sql);
            echo "l'article a été posté.";
        }

}

 }else{
echo "vous devez vous connectez pour créer une conversation";

     }

 ?>
