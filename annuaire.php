<?php
$titre = "Annuaire";
include("includes/identifiant.php");
include("includes/header.php");

?>

  <h2> Annuaire des membres du forum </h2>
    <div class="annuaire">

    <?php $query = $db->prepare('SELECT *
    FROM utilisateurs ORDER BY login ASC');
    $query->execute(); ?>
  <table>
    <thead>
      <th> Profil </th>
      <th> Localisation </th>
      <th> Website </th>
      <th> E-mail </th>
    </thead>
    <?php while ($data = $query->fetch())
    {
    ?>
    <tbody>
      <tr>
        <td><a class= "a_annuaire" href="voirprofil.php?m=<?php echo $data['id']; ?>"><?php echo $data['login'] ?></a></td>
        <td><?php echo $data['localisation'] ?></td>
        <td><?php echo $data['website'] ?></td>
        <td><?php echo $data['email'] ?></td>
      </tr>
    </tbody>

<?php
}
?>
</table>

</div>
<?php include ('includes/footer.php') ?>

  </body>
</html>
