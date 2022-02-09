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

  return $errorCount;
  }

?>