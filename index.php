<?php
# Afficher les dernières conversations/messages
include("includes/identifiant.php");
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
     <?php
     # Afficher les messages
     $sql = 'SELECT * FROM messages ORDER BY date DESC';
     $params = [];
     $resultats = $bdd->prepare($sql);
     $resultats->execute($params);

     if ($resultats->rowCount() > 0)
     {
       ?>
       <table>
         <thead>
           <tr>
             <th> Message </th>
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
   </body>
  </html>
