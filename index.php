<?php
if(isset($_GET['deconnexion'])){
  session_start();
  session_destroy();
}
# Afficher les dernières conversations/messages
$titre = "Accueil";
include("includes/header.php");
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


        <?php  $TotalDesUtilisateurs = $db->query('SELECT COUNT(*) FROM utilisateurs')->fetchColumn();
          $query = $db->query('SELECT login, id FROM utilisateurs ORDER BY id DESC LIMIT 0, 1');
          $data = $query->fetch();
          $dernierutilisateur= stripslashes(htmlspecialchars($data['login']));
          $totaldesmessages = $db->query('SELECT COUNT(*) FROM messages')->fetchColumn();
          ?>

          <html lang="en" dir="ltr">
            <head>
              <link rel="stylesheet" href="../css/footer.css">
            </head>
            <body>

            </body>
          </html>
          <?php

          $date = date("d-m-Y");
          $heure = date("H:i");
          echo("Nous sommes le $date et il est $heure");
          echo'<p>Le total des messages du forum est <strong>'.$totaldesmessages.'</strong>.<br />';
          echo'Le site et le forum comptent <strong>'.$TotalDesUtilisateurs.'</strong> utilisateurs.<br />';
          echo'Le dernier membre inscrit est <a href="./voirprofil.php?m='.$data['id'].'&amp;action=consulter">'.$dernierutilisateur.'</a>.</p>';
          echo '<a href="regles.php"> Accéder aux CGU du forum </a>';

          $query->CloseCursor();
          ?>
          </div>



        </div>

        <div class="index_links">
          <p>- Lien 1 <br>
          - Lien 2 </p>
        </div>

        <?php include('includes/footer.php') ?>
   </body>
  </html>
