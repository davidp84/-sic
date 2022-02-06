<!DOCTYPE html>
<html lang='en'>
  
<?php
  include_once("tools.php"); 
  topModule("OrbicoBiz");
  
  // Allows user to logout from Member's page
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['status'])) {
      LogIO();
    } else {
      unset($_SESSION['user']);
    }
  }
  
  navContent();
  
  membersContent();
  
  endModule()
?>