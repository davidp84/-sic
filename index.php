<!DOCTYPE html>
<html lang='en'>

<?php 

include ('tools.php');

$result = '';

topModule("Homelink");

// if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['status'])) {
    LogIO();
  } else {
    unset($_SESSION['user']);
  }

  // sets the SESSION data dependant on which form has been filled
  // and calls the method to create the relevant block. Also unsets 
  // the POST data. 
//   if ($_POST['variant'] == "permit") {
//   $_SESSION['propertyAddress'] = $_POST['address'];
//   $_SESSION['ownerDetails'] = $_POST['name'];
//   $file = $_FILES;
//   $hashedfile = hashFile($file);
//   uploadFile($file);
//   $_SESSION['buildingDesign'] = $file;
//   $_SESSION['licence'] = $_POST['licence'];
//   unset($_POST);
//   $result = createSellerBlock();
//   echo "Your Permit ID is: " . $result;
//  } else if ($_POST['variant'] == "authority") {
//   $_SESSION['decision'] = $_POST['decision'];
//   $_SESSION['property'] = $_POST['address'];
//   unset($_POST);
//   $result = createAuthorityBlock();
//  } else if ($_POST['variant'] == "loan") {
//   $_SESSION['name'] = $_POST['name'];
//   $_SESSION['DOB'] = $_POST['dob'];
//   $_SESSION['currentAddress'] = $_POST['currentAddress'];
//   $_SESSION['number'] = $_POST['number'];
//   $_SESSION['employer'] = $_POST['employer'];
//   $_SESSION['income'] = $_POST['income'];
//   $_SESSION['propertyAddress'] = $_POST['address'];
//   $_SESSION['loanAmount'] = $_POST['loan'];
//   unset($_POST);
//   $result = createBuyerBlock();
//  } else if ($_POST['variant'] == "bank") {
//   $_SESSION['decision'] = $_POST['decision'];
//   $_SESSION['name'] = $_POST['name'];
//   $_SESSION['currentAddress'] = $_POST['address'];
//   $_SESSION['number'] = $_POST['number'];
//   $_SESSION['DOB'] = $_POST['dob'];
//   unset($_POST);
//   $result = createBankBlock();
//  }

// }  
  navContent();   
    
?>

<main>

<h1>Home Page</h1>

<?= formBuilder(); ?>
      <!-- <h2>Create Permit Application</h2>
      <form class='shop-form' method='post' action="" enctype="multipart/form-data" >
      <input type='hidden' id="variant" name='variant' value="permit" />
      <p>Property Address</p>
      <input class="address" type='text' id="address" name='address' pattern="^[\da-zA-Z '\-\/.,]+$" value=""/>
      <p>Owner/Vendor Details</p>
      <input class="textfield" type='text' id="name" name='name' pattern="^[a-zA-Z '\-.]+$" value=""/>
      <p>Building Design</p>
      <input class="textfield" type='file' id="design" name='design' value="upload"/>
      <p>Seller Licence Number</p>
      <input class="textfield" type='text' id="licence" name='licence' value=""/>
      <input class="order-button" type='submit' name='permit' value='Create Permit Application' >
      </form>

      <h2>Authority Approval</h2>
      <form class='shop-form' method='post' action=""  >
      <input type='hidden' id="variant" name='variant' value="authority" />
      <p>Decision</p>
      <input class="textfield" type='text' id="decision" name='decision' value=""/>
      <p>Property Address</p>
      <input class="address" type='text' id="address" name='address' value=""/><br><br>
      <input class="order-button" type='submit' name='authority' value='Create Athority Approval'>
      </form>

      <h2>Loan Application</h2>
      <form class='shop-form' method='post' action=""  >
      <input type='hidden' id="variant" name='variant' value="loan" />
      <p>Full Name</p>
      <input class="textfield" type='text' id="name" name='name' pattern="^[a-zA-Z '\-.]+$" value=""/>
      <p>Date Of Birth</p>
      <input class="textfield" type='text' id="dob" name='dob' value=""/>
      <p>Current Address</p>
      <input class="address" type='text' id="currentAddress" name='currentAddress' value=""/>
      <p>Phone Number</p>
      <input class="textfield" type='text' id="number" name='number' pattern="^^(\(0\d\)|0\d|\+61\d|)( ?\d){8}$" value=""/>
      <p>Employer Name</p>
      <input class="textfield" type='text' id="employer" name='employer' value=""/>
      <p>Annual Income</p>
      <input class="textfield" type='text' id="income" name='income' value=""/>
      <p>Address of the Property intended to buy</p>
      <input class="address" type='text' id="address" name='address' value=""/>
      <p>Loan Amount</p>
      <input class="textfield" type='text' id="loan" name='loan' value=""/>
      <input class="order-button" type='submit' name='loan' value='Create Loan Application'>
      </form>

      <h2>Bank Loan Approval</h2>
      <form class='shop-form' method='post' action=""  >
      <input type='hidden' id="variant" name='variant' value="bank" />
      <p>Decision</p>
      <input class="textfield" type='text' id="decision" name='decision' value=""/>
      <p>Full Name</p>
      <input class="textfield" type='text' id="name" name='name' pattern="^[a-zA-Z '\-.]+$" value=""/>
      <p>Current Address</p>
      <input class="address" type='text' id="address" name='address' value=""/>
      <p>Phone Number</p>
      <input class="textfield" type='text' id="number" name='number' pattern="^^(\(0\d\)|0\d|\+61\d|)( ?\d){8}$" value=""/>
      <p>Date Of Birth</p>
      <input class="textfield" type='text' id="dob" name='dob' value=""/>
      <input class="order-button" type='submit' name='bank' value='Create Bank Loan Approval'>
    </form> -->
</main>

<?= footerModule(); ?>
<!-- Uncomment the debugModule to view arrays at bottom of webpage -->
<!-- <?= debugModule(); ?> --> 

