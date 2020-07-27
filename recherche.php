<?php
$titre = "Faire une recherche";
include("includes/identifiant.php");
include("includes/header.php");
?>

<center>
<h2>Chercher une conversation par son titre ou son contenu, tapez un mot !</h2>

<div class="recherche">

   <form method="POST" action="" name="recherche">
    <input type="text" name="recherche">
   <button type="submit"><i class="fa fa-search" name="submit"></i></button>
   </form>

   <?php

// Récupère la recherche

# $recherche = isset($_POST['recherche']) ? $_POST['recherche'] : '';

$query = "SELECT * FROM conversations";

if (isset($_POST['recherche'])) {

      $query .= ' WHERE titre LIKE ? OR conversation LIKE ?';
      $recherche = "%" . addcslashes($_POST['recherche'], '_') . "%";
      $resultats = $db->prepare($query);
      $resultats->execute([$recherche, $recherche]);
      if ($resultats->rowCount() > 0) {
        while ($d = $resultats->fetch(PDO::FETCH_ASSOC)) { ?>
          <hr>
          <div class="resultat">
            <p class = "titre_resultat"><?= str_replace('\\', '', $d['titre']) ?></p>
            <p class = "message_resultat"><?= str_replace('\\', '', $d['conversation']) ?></p>
            <p class = "liens_resultat"><a href="messages.php?id=<?= $d["id"] ?>">Voir la conversation</a></p>
          </div>
<?php
        }
      }
}
?>

</div>

</center>
</div>


<center><h4> Vous ne savez pas quoi discuter ? Voici quelques idées de topics à visiter, cliquez pour en savoir plus</h4>


<button type="button" class="collapsible">Embauche</button>
<div class="content">
  <a href="topics.php?id=3"> Nouveau contrat de travail, négociation de salaire et des horaires, adaptation
  dans un environnement de travail, tout ce qu'il faut savoir à l'embauche. </a>
</div>
<button type="button" class="collapsible">Maladie et accident</button>
<div class="content">
  <a href="topics.php?id=2">Arrêt maladie, accident au travail suscitent beaucoup de question, particulièrement
  dans cette période de covid19, venez en parler. </a>
</div>
<button type="button" class="collapsible">Licenciement</button>
<div class="content">
  <a href="topis.php?id=3">La perte de son travail est une peur pour la majorité d'entre nous, comment faire et se défendre ? Cliquez ici pour
  en parler avec d'autres membres concernés.</a>
</div></center>


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
<?php include ('includes/footer.php') ?>
</body>
</html>
