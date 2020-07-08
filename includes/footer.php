<?php
echo'<div id="footer">
<h2>
Qui est en ligne ?
</h2>
';
$TotalDesUtilisateurs = $db->query('SELECT COUNT(*) FROM utilisateurs')->fetchColumn();
$query = $db->query('SELECT login, id FROM utilisateurs ORDER BY id DESC LIMIT 0, 1');
$data = $query->fetch();
$dernierutilisateur= stripslashes(htmlspecialchars($data['login']));
?>

<html lang="en" dir="ltr">
  <head>
<link rel="stylesheet" href="footer.css">
  </head>
  <body>

  </body>
</html>
<?php
echo'<p>Le total des messages du forum est <strong>'.$totaldesmessages.'</strong>.<br />';
echo'Le site et le forum comptent <strong>'.$TotalDesUtilisateurs.'</strong> utilisateurs.<br />';
echo'Le dernier membre est <a href="./voirprofil.php?m='.$data['id'].'&amp;action=consulter">'.$dernierutilisateur.'</a>.</p>';
$query->CloseCursor();
?>
</div>
</body>
</html>
