<?php

  $address = '';
  $addressError = '';
  $name = '';
  $nameError = '';


  $errorCount = 0;

  function validatePostData() {
  if (!isset($_POST['address'])) {
    $addressError = "Address can't be blank!";
    $errorCount++;
  } else {
    $address = $_POST['address'];
    htmlspecialchars($address);
    htmlentities($addresss);
  }

  if (isset($_POST['name'])) {
    $name = $_POST['name'];
    htmlspecialchars($name);
    htmlentities($name);
    if (filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => 
    array("regexp"=>"^[a-zA-Z '\-.]+$"))) === false) {
      $nameError = "Is that really your name?";
      $errorCount++;
    }
  }

  return $errorCount;
  }

?>