<?php
# Afficher les dernières conversations/messages
$titre = "Accueil";
include("includes/header.php");

if(isset($_GET['deconnexion'])){

session_destroy();
     unset($_SESSION['login']);
     //au bout de 2 secondes redirection vers la page d'accueil
     header("Refresh: 1; url=index.php");

     echo "<p>Vous avez été déconnecté</p>";
 }

 ?>
 <!DOCTYPE html>
 <html lang="fr" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Modération</title>
     <link rel="stylesheet" href="css/style.css">
     <link rel="stylesheet" href="css/header.css">
     <link rel="stylesheet" href="css/table.css">
   </head>

   <body>
     <div class="grid">
       <div class= "last_messages">
           <?php
           # Afficher les messages
           $sql = 'SELECT * FROM messages ORDER BY date DESC';
           $params = [];
           $resultats = $db->prepare($sql);
           $resultats->execute($params);

           if ($resultats->rowCount() > 0)
           {
             ?>
             <table>
               <thead>
                 <tr>
                   <th> Derniers messages postés </th>
                 </tr>
               </thead>
               <?php
               while ($d = $resultats->fetch(PDO::FETCH_ASSOC))
               {
                 ?>
                 <tbody>
                   <tr>
                     <td><?=$d['message'] ?></td>
                   </tr>
                 </tbody>
               <?php } ?>
             </table>
             <?php
           } ?>
         </div>

        <div class="index_topics">
          <?php
          # Afficher les messages
          $sql = 'SELECT * FROM topics';
          $params = [];
          $resultats = $db->prepare($sql);
          $resultats->execute($params);

          if ($resultats->rowCount() > 0)
          { ?>
            <ul class="index_list">
              <?php while ($d = $resultats->fetch(PDO::FETCH_ASSOC))
              {
                echo '<li>' . $d['topic'] .'</li> <br>';
               } ?>
            </ul>
          <?php } ?>
         </div>

        <div class="stats">
          <p> Ici s'afficheront les statistiques. </p>
        </div>

        <div class="index_links">
          <p>- Lien 1 <br>
          - Lien 2 </p>
        </div>
   </body>
  </html>
