<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
if(isset($_POST['captcha'])){//Le formulaire est envoyé, on traite les données...
    if($_POST['captcha']!=$_SESSION['captcha']){//si le captcha sélectionné n'est pas le bon
        echo "Captcha incorrect!";//on stop le traitement
    } else {
        echo "Captcha correct!";
        //on continu le traitement...
    }
}
/**
 La partie de code suivante doit impérativement être placée en dessous de la vérification des champs du formulaire, sinon le code sera toujours faux lors de sa vérification car il sera toujours un nouveau code
 **/

//si le formulaire n'est pas encore été cliqué, on défini le captcha
$NombreDeCaractCode=4;//vous pouvez définir ici combien vous souhaitez avec de caractères pour chaque code
$NombreDeCodes=5;//vous pouvez définir ici combien vous souhaitez avoir de faux codes à choisir dans la liste déroulante
$CodeCaptcha=substr(str_shuffle("ABCDEFGHIJKLMNPQRSTUVWXYZ123456789"),0,$NombreDeCaractCode);//j'ai enlevé le O (lettre o) et le 0 (chiffre 0) volontairement car ils peuvent prêter à confusion
$_SESSION['captcha']=$CodeCaptcha;//pensez à bien initialiser la session avec "session_start();" tout en haut de votre page, avant n'importe quel balise HTML
$ListeCodes[]=$CodeCaptcha;//initiation du tableau qui contiendra tous les faux codes à choisir dans la liste
for($i=1;$i<=($NombreDeCodes-1);$i++){
    $ListeCodes[]=substr(str_shuffle("ABCDEFGHIJKLMNPQRSTUVWXYZ123456789"),0,$NombreDeCaractCode);
}
shuffle($ListeCodes);//on mélange tous les codes
/**
 Fin de la partie code à placé en dessous de la vérification des champs
 **/
?><br/>
<form method="post">
<!-- ici les autres champs de mon formulaire -->
...ici le contenu de mon formulaire...
<br/>
<br/>
Choisissez le code <?php echo $_SESSION['captcha']; ?> dans la liste suivante:
<select name="captcha" onchange="this.form.submit()"><!-- avec  onchange="this.form.submit()" on valide le formulaire dès qu'il à choisi le code! -->
    <option>Choissiez le code affiché:</option>
    <?php foreach($ListeCodes as $Code){ ?>
        <?php echo '<option value="'.$Code.'">'.$Code.'</option>'; ?>
    <?php } ?>
</select>
<input type="submit" name="valider" value="Valider"> <!-- on laisse le bouton valider au cas où le javascript ne serait pas activé sur le navigateur du visiteur -->
</form>
</body>
</html>
