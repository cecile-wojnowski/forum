<div class="navbar_bottom">
      <a href="index.php"><center>Accueil</center></a>
      <a href="topics.php"> Topics  </a>
      <a href="regles.php"> Accéder aux CGU du forum </a>
      <a href="contact.php">Nous contacter</a>

    </div>
<?php
echo'<div id="footer">
<h2>
Infos sur votre forum préféré
</h2>
';
$TotalDesUtilisateurs = $db->query('SELECT COUNT(*) FROM utilisateurs')->fetchColumn();
$query = $db->query('SELECT login, id FROM utilisateurs ORDER BY id DESC LIMIT 0, 1');
$data = $query->fetch();
$dernierutilisateur= stripslashes(htmlspecialchars($data['login']));
$totaldesmessages = $db->query('SELECT COUNT(*) FROM messages')->fetchColumn();


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
</body>
</html>
