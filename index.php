<!DOCTYPE html>
<html lang='en'>

<?php 

include ('tools.php');

$result = '';

topModule("Homelink");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['status'])) {
    LogIO();
  } else {
    unset($_SESSION['user']);
  }

 }  
  navContent();   
    
?>

<main>

<h1>Home Page</h1>

<?= formBuilder(); ?>
     
</main>

<?= footerModule(); ?>

<br><br><br>
--------------------------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------------------------
<br>
BELOW IS PRINTED FOR TEACHER"S MARKING PURPOSES!

<?= debugModule(); ?> 

