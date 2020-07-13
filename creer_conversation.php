
 <?php

 include("includes/identifiant.php");
 include("includes/header.php");
 include("./includes/function.php");


 if($_SERVER['REQUEST_METHOD'] != 'POST')
 {
   if (isset($_SESSION['login'])){
     //the form hasn't been posted yet, display it
     echo "<form method='post' action=''>
         Category name: <input type='text' name='cat_name' />
         Category description: <textarea name='cat_description' /></textarea>
         <input type='submit' value='Add category' />
      </form>";
 }
 else
 {
echo "vous devez vous connectez pour créer une converation";

     }
 }
 ?>
