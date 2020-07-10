<?php
function erreur($err='')
{
   $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
   exit('<p>'.$mess.'</p>
   <p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p></div></body></html>');
}

function verif_auth($auth_necessaire)
{
  $level=(isset($_SESSION['level']))?$_SESSION['level']:1;
  return ($auth_necessaire <= intval($level));
}


  ?>
