<!DOCTYPE html>
<html lang='en'>

<?php 

include ('tools.php');
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
      <h2>Order Form</h2>
      <form id="order" >
      <p>Name</p>
      <input class="textfield" type='text' id="name" name='name' pattern="^[a-zA-Z '\-.]+$" value=""/>
      <p>Email</p>
      <input class="textfield" type='text' id="email" name='email' value=""/>
      <p>Mobile</p>
      <input class="textfield" type='text' id="mobile" name='mobile' pattern="^^(\(04\)|04|\+614)( ?\d){8}$" value=""/>
      <p>Address</p>
      <input class="address" type='text' id="address" name='address' pattern="^[\da-zA-Z '\-\/.,]+$" value=""/><br><br>
      <label for="remember-me"><input class="checkbox" type='checkbox' id="remember-me" name='remember-me' onchange='rememberMe()' >Remember Me</label><br>
      <input class="order-button" type='submit' name='complete-order' value='Complete Order (disabled)' disabled='true'>
      </form>

</main>

<?= footerModule() ?>
