<?php
$titre = "Annuaire";
include("includes/identifiant.php");
include("includes/header.php");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table>
      <h2> Tout les membres inscrits sur le forum </h2>
<div class="annuaire">

    <?php $query = $db->prepare('SELECT *
    FROM utilisateurs ORDER BY login ASC');
$query->execute();
while ($data = $query->fetch())
{
?>
<table class="" style="text-align:right">

    <tbody>
      <tr>
        <td scope=""><a href="voirprofil.php?m=<?php echo $data['id']; ?>"><?php echo $data['login'] ?></a></td>
        <th scope=""><?php echo $data['localisation'] ?></th>
        <td scope=""><?php echo $data['website'] ?></td>
        <td scope=""><?php echo $data['email'] ?></td>
      </tr>
    </tbody>
  </table>


</table>



<?php
}
?></div>
<?php include ('includes/footer.php') ?>

  </body>
</html>
