
<?php
include("includes/identifiant.php");
include("includes/header.php");
include("includes/function.php");


?>




<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>



</style>
</head>
<body>

<center>
<h2>Faire une recherche sur le site</h2>
</center>

<?php

  if (isset($_POST['submit'])) {
$sql = 'SELECT * FROM messages';
  $params = [];

      $sql .= ' where messages like :message';
      $params[':message'] = "%" . addcslashes($_POST['recherche_valeur'], '_') . "%";

  $resultats = $db->prepare($sql);
  $resultats->execute($params);
  if ($resultats->rowCount() > 0) {
      while ($d = $resultats->fetch(PDO::FETCH_ASSOC)) {

        var_dump($sql);

          ?>

          <div class="">
          	<tr><td><?=$d['message'] ?></td><td><?=$d['id'] ?></td>
          		<td><?=$d['id_utilisateur'] ?></td>
          </div>

          				 <?php
                  }
              }
            } else {
                  echo '<tr><td>aucun résultat trouvé</td></tr>' . $connect = null;
              } ?>
<?php  ?>

<p><center>Tapez l'expression recherchée dans une conversation </center></p>
<form class="example" name="recherche_valeur" action="" style="margin:auto;max-width:500px">
  <input type="text" placeholder="rechercher.." name="recherche_valeur">
  <button type="submit"><i class="fa fa-search" name="submit"></i></button>
</form>

<center><h3> Vous ne savez pas quoi discuter ? Voici quelques idées de topics à visiter, cliquez pour en savoir plus</h3></center>

<button type="button" class="collapsible">Topic 1</button>
<div class="content">
  <a href="topics.php?id=1">Description du topic 1... </a>
</div>
<button type="button" class="collapsible">Topic 2</button>
<div class="content">
  <a href="topics.php?id=2">Description du topic 2...</a>
</div>
<button type="button" class="collapsible">Topic 3</button>
<div class="content">
  <a href="topis.php?id=3">Description du topic 3...</a>
</div>


<script>

var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
<?php include('includes/footer.php')?>
</body>
</html>
