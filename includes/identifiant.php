<?php
# Permet d'établir la connexion avec la base de données
try
{
    $db = new PDO('mysql:host=localhost;dbname=forum', 'root', '');
    $db->exec("SET CHARACTER SET utf8");

}
catch(Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>
