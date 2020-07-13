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
?>

<html lang="en" dir="ltr">
  <head>
<link rel="stylesheet" href="footer.css">
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
echo'Le dernier membre inscrit est <a href="./voirprofil.php?'.'m='.$data['id'].'">'.$dernierutilisateur.'</a>.</p>';
echo '<a href="regles.php"> Accéder aux CGU du forum </a>';



$query->CloseCursor();
?>
</div>
</body>
</html>
