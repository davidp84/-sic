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
  <h2 class='company-name'>Homelink</h2>
  <a href='index.php'>
      <!-- img used for educational purposes only, note this will be relpaced with a new logo -->
  <img class='logo' src='https://i.pinimg.com/564x/74/94/ed/7494ed64686f16ed0535873c1c2790e1.jpg' alt='The Temp Plotters Logo' width="750" height="350">
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


<article> 

<h1>Meet The Team</h1>
<p>Timothy Hall - s3851553</p>
<p>John Rehill - s3828158</p>
<p>David Pulvirenti - s3858853</p>
<p>Jacob Hooper - s3903479</p>
<p>Mitchell Abrahams - s3792975</p>

<h1>The Motivation Behind The Temp Plotters</h1>

<p>The motivation for the Temp Plotters team was that everyone in 
  the team wanted to develop, design, and produce a small IT project 
  that implemented a microcomputer along with some form of sensor. 
  Everyone already had some experience with coding; however, 
  implementing something based around hardware was exciting and 
  provided additional learning that could complement our existing 
  coding experience.</p>
  
<p>After initial discussion, the idea of making a HVAC control unit 
utilising a Raspberry Pi and a temperature and a humidity sensor 
would be a great starting point for the project. Through research 
into the hardware, components, and discussion amongst each other 
it was decided to expand this to include a website component to 
round out the project and provide a user interface.</p>

<h1>Project Description</h1>

<p>The project for this team was to design a HVAC using a Raspberry 
  Pi as a main control system with sensor components for temperature 
  and humidity that would also have a control fan. The project aim 
  was to develop a system that would detect ambient temperature 
  and/or humidity changes and respond by turning on the fan component.</p>

<p>As an additional feature, the system would be configured to send 
  an email alert to a system administrator notifying them of the rise 
  in temperature. As extra demonstratable outcomes, the project also 
  involved designing a website that would display the statistics from 
  the sensors.</p>

  <p>It was envisioned that the system could be further expanded to 
  include a heating element for periods when the ambient temperature
  would be below a threshold and a de-humidifier to remove excess 
  moisture from the area.</p>

</artcile>

</main>

<?= footerModule() ?>