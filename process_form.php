<!DOCTYPE html>
<html lang='en'>
  
<?php
  include_once("tools.php"); 
  topModule("OrbicoBiz");
  
  // sets the SESSION data dependant on which form has been filled
  // and calls the method to create the relevant block. Also unsets 
  // the POST data. 
  // Displays relevant receipts. 
  if ($_POST['variant'] == "permit") {
    $_SESSION['propertyAddress'] = $_POST['address'];
    $_SESSION['ownerDetails'] = $_POST['name'];
    $file = $_FILES;
    $hashedfile = hashFile($file);
    uploadFile($file);
    $_SESSION['buildingDesign'] = $file;
    $_SESSION['licence'] = $_POST['licence'];
    unset($_POST);
    $result = createSellerBlock();
    echo "Your Permit ID is: " . $result;
    echo "<a href=index.php>Click here to return to homepage</a>";
   } else if ($_POST['variant'] == "authority") {
    $_SESSION['decision'] = $_POST['decision'];
    $_SESSION['property'] = $_POST['address'];
    unset($_POST);
    $result = createAuthorityBlock();
    echo "Your decision has been saved";
    echo "<a href=index.php>Click here to return to homepage</a>";
   } else if ($_POST['variant'] == "loan") {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['DOB'] = $_POST['dob'];
    $_SESSION['currentAddress'] = $_POST['currentAddress'];
    $_SESSION['number'] = $_POST['number'];
    $_SESSION['employer'] = $_POST['employer'];
    $_SESSION['income'] = $_POST['income'];
    $_SESSION['propertyAddress'] = $_POST['address'];
    $_SESSION['loanAmount'] = $_POST['loanAmount'];
    unset($_POST);
    $result = createBuyerBlock();
    echo "Your Loan Application ID is: " . $result;
    echo "<a href=index.php>Click here to return to homepage</a>";
   } else if ($_POST['variant'] == "bank") {
    $_SESSION['decision'] = $_POST['decision'];
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['currentAddress'] = $_POST['address'];
    $_SESSION['number'] = $_POST['number'];
    $_SESSION['DOB'] = $_POST['dob'];
    unset($_POST);
    $result = createBankBlock();
    echo "Your decision has been saved";
    echo "<a href=index.php>Click here to return to homepage</a>";
   }

?>