<!DOCTYPE html>
<html lang='en'>

<?php 

include ('tools.php');

$result = '';

topModule("Homelink");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require("post-validation-seller.php");

  if (isset($_POST['status'])) {
    LogIO();
  } else {
    unset($_SESSION['user']);
  }

  // if (validatePostData()) {
  $_SESSION['propertyAddress'] = $_POST['address'];
  $_SESSION['ownerDetails'] = $_POST['name'];
  $_SESSION['buildingDesign'] = $_POST['design'];
  $_SESSION['licence'] = $_POST['licence'];
  unset($_POST);
  // }

//  if (!isset($_SESSION['propertyAddress']) || $_SESSION['propertyAddress'] == null) {
//   errorMessage();
// } else {
  //run else if's for the different forms. Via $_POST['variant'].
  $result = createSellerBlock();
    // unset($_SESSION);
// }


// echo "\n\n<pre id='debug'>";
// print_r($_POST);
// print_r($_SESSION);
// foreach($blockchain as $key => $value){
//   print_r($key);
//   print_r("has the value");
//   print_r($value);
// }
// echo "</pre>\n\n";
}  
  navContent();   
    
?>

<main>

<h1>Home Page</h1>
      <h2>Create Permit Application</h2>
      <form class='shop-form' method='post' action=""  >
      <p>Property Address</p>
      <input class="address" type='text' id="address" name='address' pattern="^[\da-zA-Z '\-\/.,]+$" value=""/><br><br>
      <p>Owner/Vendor Details</p>
      <input class="textfield" type='text' id="name" name='name' pattern="^[a-zA-Z '\-.]+$" value=""/>
      <p>Building Design</p>
      <input class="textfield" type='text' id="design" name='design' value=""/>
      <p>Seller Licence Number</p>
      <input class="textfield" type='text' id="licence" name='licence' value=""/>
      <input class="order-button" type='submit' name='complete-order' value='Complete Order' >
      </form>

      <h2>Authority Approval</h2>
      <form id="order" >
      <p>Decision</p>
      <input class="textfield" type='text' id="name" name='name' pattern="^[a-zA-Z '\-.]+$" value=""/>
      <p>Property Address</p>
      <input class="address" type='text' id="address" name='address' pattern="^[\da-zA-Z '\-\/.,]+$" value=""/><br><br>
      <input class="order-button" type='submit' name='complete-order' value='Complete Order (disabled)' disabled='true'>
      </form>

      <h2>Loan Application</h2>
      <form form class='shop-form' method='post' action="" onsubmit="return validatePostData()" >
      <p>Full Name</p>
      <input class="textfield" type='text' id="name" name='name' pattern="^[a-zA-Z '\-.]+$" value=""/>
      <p>Date Of Birth</p>
      <input class="textfield" type='text' id="mobile" name='mobile' pattern="^^(\(04\)|04|\+614)( ?\d){8}$" value=""/>
      <p>Current Address</p>
      <input class="address" type='text' id="address" name='address' pattern="^[\da-zA-Z '\-\/.,]+$" value=""/><br><br>
      <p>Phone Number</p>
      <input class="textfield" type='text' id="mobile" name='mobile' pattern="^^(\(04\)|04|\+614)( ?\d){8}$" value=""/>
      <p>Employer Name</p>
      <input class="textfield" type='text' id="name" name='name' pattern="^[a-zA-Z '\-.]+$" value=""/>
      <p>Annual Income</p>
      <input class="textfield" type='text' id="email" name='email' value=""/>
      <p>Address of the Property intended to buy</p>
      <input class="address" type='text' id="address" name='address' pattern="^[\da-zA-Z '\-\/.,]+$" value=""/><br><br>
      <p>Loan Amount</p>
      <input class="textfield" type='text' id="mobile" name='mobile' pattern="^^(\(04\)|04|\+614)( ?\d){8}$" value=""/>
      <input class="order-button" type='submit' name='complete-order' value='Complete Order (disabled)' disabled='true'>
      </form>

      <h2>Bank Loan Approval</h2>
      <form id="order" >
      <p>Decision</p>
      <input class="textfield" type='text' id="name" name='name' pattern="^[a-zA-Z '\-.]+$" value=""/>
      <p>Full Name</p>
      <input class="textfield" type='text' id="name" name='name' pattern="^[a-zA-Z '\-.]+$" value=""/>
      <p>Current Address</p>
      <input class="address" type='text' id="address" name='address' pattern="^[\da-zA-Z '\-\/.,]+$" value=""/><br><br>
      <p>Phone Number</p>
      <input class="textfield" type='text' id="mobile" name='mobile' pattern="^^(\(04\)|04|\+614)( ?\d){8}$" value=""/>
      <p>Date Of Birth</p>
      <input class="textfield" type='text' id="mobile" name='mobile' pattern="^^(\(04\)|04|\+614)( ?\d){8}$" value=""/>
  
    </form>
</main>

<?= footerModule() ?>
<?= debugModule() ?>
