<?php

  $firstname = '';
  $firstnameError = '';
  $surname = '';
  $surnameError = '';
  $phone = '';
  $phoneError = '';
  $email = '';
  $emailError = '';
  $qty = '';
  $qtyError = '';
  $variant = '';
  $variantError = '';
  $product = '';
  $productError = '';

  $errorCount = 0;

  function validatePostData() {
  //Reference [2]
  if (!isset($_POST['firstname'])) {
    $firstnameError = "First name can't be blank!";
    $errorCount++;
  } else {
    $firstname = $_POST['firstname'];
    htmlspecialchars($firstname);
    htmlentities($firstname);
    if (filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => 
    array("regexp"=>"^[a-zA-Z '\-.]+$"))) === false) {
      $firstnameError = "Is that really your first name?";
      $errorCount++;
    }
  }

  if (isset($_POST['surname'])) {
    $surname = $_POST['surname'];
    htmlspecialchars($surname);
    htmlentities($surname);
    if (filter_var($surname, FILTER_VALIDATE_REGEXP, array("options" => 
    array("regexp"=>"^[a-zA-Z '\-.]+$"))) === false) {
      $surnameError = "Is that really your Surname?";
      $errorCount++;
    }
  }

  if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
    $patt = "^(\(04\)|04|\+614)( ?\d){8}$";
    htmlspecialchars($phone);
    htmlentities($phone);
    if (!preg_match($patt, $phone)) {
      $phoneError = "Please only use an Australian Mobile Number?";
      $errorCount++;
    } 
  }

  if (isset($_POST['email'])) {
    $email = $_POST['email'];
    htmlspecialchars($email);
    htmlentities($email);
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
      $emailError = "Did you mean to type '". filter_var($email, FILTER_SANITIZE_EMAIL)."'?";
      $errorCount++;
    }
  }

  if (isset($_POST['qty'])) {
    $minQty = 1;
    $maxQty = 100;
    $qty = $_POST['qty'];
    htmlspecialchars($qty);
    htmlentities($qty);
    if (filter_var($qty,FILTER_VALIDATE_INT, array("options" => 
      array("min_range"=>$minQty))) === false) {
        $qtyError = "Minimum quantity is 1!";
        $errorCount++;
      }
    }

    if (filter_var($qty,FILTER_VALIDATE_INT, array("options" => 
      array("max_range"=>$maxQty))) === false) {
        $qtyError = "Maximum quantity is 100!";
        $errorCount++;
    }

  $qty = filter_var($qty, FILTER_SANITIZE_NUMBER_INT);
  

  if (isset($_POST['variant'])) {
    $variant = $_POST['variant'];
    htmlspecialchars($variant);
    htmlentities($variant);
    
    switch ($variant) {
      case "small":
        break;
      case "medium":
        break;
      case "large":
        break;
      default:
        $variantError = "That option does not exist!";
        $errorCount++;
        break;  
    }
  }

  
  if (isset($_POST['product'])) {
    $product = $_POST['product'];
    htmlspecialchars($product);
    htmlentities($product);
    
    switch ($product) {
      case "counselling":
        break;
      case "presentation":
        break;
      case "supervision":
        break;
      default:
        $productError = "That product does not exist!";
        $errorCount++;
        break;  
    }
  }

  return $errorCount;
  }

?>