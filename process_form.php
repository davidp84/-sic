<!DOCTYPE html>
<html lang='en'>
  
<?php
  include_once("tools.php"); 
  topModule("OrbicoBiz");
  
  // sets the SESSION data dependant on which form has been filled
  // and calls the method to create the relevant block. Also unsets 
  // the POST data. 
  // Displays relevant receipts. 
  // Displays search results.
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
   } else if ($_POST['variant'] == "permitSearch") {
    $id = $_POST['permitSearchID'];
    foreach ($_SESSION['blockchain'] as $block => $chain) {
      if (strcmp($chain['']['hash'], $id) === 0) {
        $property = $chain['']['data']['property'];
      }
    }
    foreach ($_SESSION['blockchain'] as $block => $chain) {
      if (strcmp($chain['']['data']['property'], $property) === 0) {
        $decision = $chain['']['data']['decision'];
      }
    }
    echo "Status is '" . $decision . "'";
    echo "<a href=index.php>Click here to return to homepage</a>";
   } else if ($_POST['variant'] == "loanSearch") {
    $id = $_POST['loanSearchID'];
    foreach ($_SESSION['blockchain'] as $block => $chain) {
      if (strcmp($chain['']['hash'], $id) === 0) {
        $name = $chain['']['data']['name'];
        $address = $chain['']['data']['propertyAddress'];
      }
    }
    foreach ($_SESSION['blockchain'] as $block => $chain) {
      if (strcmp($chain['']['data']['name'], $name) === 0) {
        $decision = $chain['']['data']['decision'];
      }
    }
    echo "Status of loan is '" . $decision . "'";
    updateDealStatus($decision, $address);  
    echo "<a href=index.php>Click here to return to homepage</a>";
   } else if ($_POST['variant'] == "dealSearch") {
    $id = $_POST['dealSearchID'];
    foreach ($_SESSION['blockchain'] as $block => $chain) {
        if (strcmp($chain['']['hash'], $id) === 0) {
          $property = $chain['']['data']['property'];
        }
    }
    foreach ($_SESSION['blockchain'] as $block => $chain) {
      if (strcmp($chain['']['data']['propertyOutcome'], $property) === 0) {
        $status = $chain['']['data']['decision'];
      }
    }
    echo "Status of the deal is '" . $status . "'";
    echo "<a href=index.php>Click here to return to homepage</a>";
   }

?>