<?php
if (isset($_GET['deconnexion']))
{
    session_start();
    session_destroy();
}
# Afficher les dernières conversations/messages
$titre = "Accueil";
include("includes/header.php");
?>
   <body>
     <article class="presentation_index">
        <h2 class="h2_index"> Bienvenue ! </h2>
        <p class= "p_index">  <br>
          Notre forum est destiné à tout les salariés qui ont des questions sur leurs conditions de travail.
          Que vous vouliez parler de salaire, d'embauche, de licenciement ou de négociation de salaire,
          vous êtes au bon endroit.
        </p>
      </article>

      <div class="last_conversation">
        <table class="table_index">
          <thead>
            <th> Dernières conversations </th>
          </thead>
          <?php $query = $db->prepare('SELECT *
                     FROM conversations ORDER BY  id ASC LIMIT 3');
          $query->execute();
          while ($data = $query->fetch())
          {
            $conversation = $data['conversation'];
            $conversation = str_replace("\'", "'", $conversation);
          ?>
                         </thead>

                           <tbody>
                             <tr>
                               <td><?=$data['titre'] ?></td>
                               <td><?=$conversation ?></td>

                             </tr>
                             <?php
          } ?>
                           </tbody>
                       </table>
        </table>
      </div>

     <div class="grid">


       <div class= "last_messages">
         <table class="table_index">
           <thead>
             <tr>
               <th>                <img src="https://img.icons8.com/clouds/100/000000/light-on.png"/>
Derniers messages postés </th>
             </tr>
           <?php
# Afficher les messages
$query = $db->prepare('SELECT *
           FROM messages ORDER BY  id ASC LIMIT 3');
$query->execute();
while ($data = $query->fetch())
{
?>
               </thead>

                 <tbody>
                   <tr>
                     <td><?=$data['message'] ?></td>
                     <td> le   <?=$data['date_message'] ?></td>

                   </tr>
                   <?php
} ?>
                 </tbody>
             </table>
         </div>



        <div class="index_topics">
          <img src="https://img.icons8.com/clouds/100/000000/info.png"/>
          <p>Les topics que vous pourrez discuter sur le forum</p>
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
                echo "-" . " " . $d['topic'] . '<br>';
              } ?>
            </ul>
          <?php
} ?>
         </div>

        <div class="stats">
<img src="https://img.icons8.com/clouds/100/000000/edit-user.png"/>
        <?php $TotalDesUtilisateurs = $db->query('SELECT COUNT(*) FROM utilisateurs')
    ->fetchColumn();
$query = $db->query('SELECT login, id FROM utilisateurs ORDER BY id DESC LIMIT 0, 1');
$data = $query->fetch();
$dernierutilisateur = stripslashes(htmlspecialchars($data['login']));
$totaldesmessages = $db->query('SELECT COUNT(*) FROM messages')
    ->fetchColumn();
?>


          <?php
$date = date("d-m-Y");
$heure = date("H:i");
echo ("Nous sommes le $date et il est $heure");
echo '<p>Le total des messages du forum est <strong>' . $totaldesmessages . '</strong>.<br />';
echo 'Le site et le forum comptent <strong>' . $TotalDesUtilisateurs . '</strong> utilisateurs.<br />';
echo 'Le dernier membre inscrit est <a href="./voirprofil.php?m=' . $data['id'] . '">' . $dernierutilisateur . '</a>.</p>';
echo '<a href="regles.php"> Accéder aux CGU du forum </a>';

$query->CloseCursor();
?>
          </div>

          <div class="index_plus">
            <img src="https://img.icons8.com/clouds/100/000000/law-document---v2.png"/>
            <p>Liens utiles pour les salariés et plébiscités par nos membres :</p>
            <p> <a href="https://travail-emploi.gouv.fr/">Ministère du travail</a> <br>
          <a href="https://www.juritravail.com/"> Juritravail </a>  </p>
          </div>
        </div>


        <?php include ('includes/footer.php') ?>
   </body>
  </html>
