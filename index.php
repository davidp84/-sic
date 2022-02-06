<!DOCTYPE html>
<html lang='en'>

<?php 

include ('tools.php');
topModule("Homelink");
    
?>


<body>
<div class='main-grid'>  
<header class='logo-header'>
<!-- <img class='logo-head' src='../../media/logo.jpg'> -->
  <h1 class='company-name'>Homelink</h1>
  <a href='index.php'>
    <!-- img used for educational purposes only, note this will be relpaced with a new logo -->
    <!-- dilayorganci, 2017. Home Link. Free icons for everything - noun project. Available at: https://thenounproject.com/icon/home-link-815698/ [Accessed February 6, 2022]. -->
  <img class='logo' src='../../media/homelink.png ' alt='The homelink Company Logo' height="350">
  </a>
</header>

<nav id="nav">
  <div>
    <ul>
      <li><a href="index.php" id="home__link">Home</a></li>
      <li><a href="about.php" class="nav_link">About</a></li>
    </ul>
  </div>
</nav>

<main>

<h1> ALERTS <h1>

<article> 

<table  class="main-table" style="width:70%">
  <tr>
    <th class="table-header">Date</th>
    <th class="table-header">Time</th>
    <th class="table-header" >Temperature</th>
    <th class="table-header">Humidity</th>
  </tr>
    <?= tableModule() ?>
</table>

</article>

</main>

<?= footerModule() ?>
