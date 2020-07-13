
<?php
include("includes/identifiant.php");
include("includes/header.php");
include("./includes/function.php");

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

<p><center>Tapez le titre d'un article</center></p>
<form class="example" action="/action_page.php" style="margin:auto;max-width:500px">
  <input type="text" placeholder="rechercher.." name="search2">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>

<center><h3>Vous ne savez pas quoi discuter ? Voici quelques idées de topics à visiter, cliquez pour en savoir plus</h3></center>

<button type="button" class="collapsible">Topic 1</button>
<div class="content">
  <a href="topics.php">Description du topic 1... </a>
</div>
<button type="button" class="collapsible">Topic 2</button>
<div class="content">
  <a href="topics.php">Description du topic 2...</a>
</div>
<button type="button" class="collapsible">Topic 3</button>
<div class="content">
  <a href="topis.php">Description du topic 3...</a>
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

</body>
</html>
