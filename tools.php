<?php
  session_start();
  error_reporting( E_ERROR | E_WARNING | E_PARSE);

  // Prints arrays to screen.
  function debugModule() {
    echo "\n\n<pre id='debug'>";
    print_r("POST\n");
    print_r($_POST);
    print_r("SESSION\n");
    print_r($_SESSION);
    print_r("REQUEST\n");
    print_r($_REQUEST);
    print_r("FILES\n");
    print_r($_FILES);
    echo "</pre>\n\n";
}

  /*
  Note for marker:
  User Alice is a Seller
  User Bob is an Authority
  User Carol is a Buyer
  User Daniel is a Bank  
  */

  $users = array(
    "Alice" => 'passwordA',
    "Bob" => 'passwordB',
    "Carol" => 'passwordC',
    "Daniel" => 'passwordD',
  );

   function logIO() {
     global $users;
      if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
      } else {
        if (!empty($_REQUEST['user']) && !empty($_REQUEST['password'])) {
          if (key_exists($_REQUEST['user'], $users)) {
            if (strcmp($users[$_REQUEST['user']], $_REQUEST['password']) === 0) {   
                   $_SESSION['user'] = $_REQUEST['user'];
          }
         }
       }
    }
}


  function topModule($title) {
  echo <<<"TOP"
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>$title</title>

<link id='stylecss' type="text/css" rel="stylesheet" href="style.css?t=<?= filemtime("style.css"); ?>
<script src='script.js'></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@300&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@300&family=Belleza&family=Noto+Serif&display=swap"
rel="stylesheet">
</head>

<body onload='loadForm()'>
<div class='main-grid'>  
<header class='logo-header'>
<!-- <img class='logo-head' src='../media/homelink.jpg'> -->
  <h2 class='company-name'>Homelink</h2>
  <a href='index.php'>
    <!-- img used for educational purposes only, note this will be relpaced with a new logo -->
    <!-- dilayorganci, 2017. Home Link. Free icons for everything - noun project. Available at: https://thenounproject.com/icon/home-link-815698/ [Accessed February 6, 2022]. -->
  <img class='logo' src='../media/homelink.png ' alt='The homelink Company Logo' height="150">
  </a>
</header>

TOP;
}

function footerModule() {
  echo <<<"END"

<footer>
  <div id='footer-contact'>
    <p>Homelink - 02 9678 1234 - info@homelink.com.au</p>
  </div>
  <div>Disclaimer: This website is not a real website and is being developed as part of a School of Science
  course at RMIT University in Melbourne, Australia.</div>
</footer>
</div>
</body>

</html>
END;
}

function navContent() {
  if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $user = ucfirst($user);
    echo <<<"NAV"
    <nav>
      <div>Logged in as $user</div>
      <ul>
        <li><a href="./">Home</a></li>
        <li><form class='login' method='post'>
        <input type=hidden id='status' name='status' value='Logout' />
        <input class='btn' type='SUBMIT' value='Logout' />
      </form></li>
      </ul>
    </nav>
NAV;
  } else {
    echo <<<"NAV"
    <nav>
      <ul>
        <li><a href="./">Home</a></li>
        <li><input type='button' class='login-btn' id='login-btn' onclick='toggleLogin()' value='Login' /></li>
      </ul>
      <form class='login' id=login method='post' hidden>
        <input type=hidden id='status' name='status' value='Login' />
        <input type='text' id="user" name='user' placeholder='username' required />
        <input type='text' id="password" name='password' placeholder='password' required />
        <input class='btn' type='SUBMIT' value='Login' />
      </form>
      
    </nav>
NAV;
  }
}

// Calls the relevant method to display the correct form based on the user's role 
function formBuilder() {
  if(isset($_SESSION['user'])) {
    if ($_SESSION['user'] === "Alice") {
      permitApplication();
    } else if ($_SESSION['user'] === "Bob") {
      authorityApproval();
    } else if ($_SESSION['user'] === "Carol") {
      loanApplication();
    } else if ($_SESSION['user'] === "Daniel") {
      bankLoanApproval();
    } 
  } else {
    echo "Please log in to access the site!";
  }
}

// displays the permit application form
function permitApplication() {
  echo <<<"FORM"
  <h2>Create Permit Application</h2>
  <form class='shop-form' method='post' action="process_form.php" enctype="multipart/form-data" >
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

  <h2>Search for loan Application</h2>
  <form class='shop-form' method='post' action="process_form.php"  >
  <input type='hidden' id="variant" name='variant' value="loanSearch" />
  <p>Please enter Loan Application id</p>
  <input class="textfield" type='text' id="loanSearchID" name='loanSearchID' value=""/>
  <input class="order-button" type='submit' name='searchLoan' value='searchLoan'>
  </form>
FORM;
}

// displays the authority approval form
function authorityApproval() {
  echo <<<"FORM"
  <h2>Authority Approval</h2>
  <form class='shop-form' method='post' action="process_form.php"  >
  <input type='hidden' id="variant" name='variant' value="authority" />
  <p>Decision</p>
  <input class="textfield" type='text' id="decision" name='decision' value=""/>
  <p>Property Address</p>
  <input class="address" type='text' id="address" name='address' value=""/><br><br>
  <input class="order-button" type='submit' name='authority' value='Create Authority Approval'>
  </form>
FORM;
}

// displays the loan application form
function loanApplication() {
  echo <<<"FORM"
  <h2>Loan Application</h2>
  <form class='shop-form' method='post' action="process_form.php"  >
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
  <input class="textfield" type='text' id="loanAmount" name='loanAmount' value=""/>
  <input class="order-button" type='submit' name='loan' value='Create Loan Application'>
  </form>

  <h2>Search for a Deal</h2>
  <form class='shop-form' method='post' action="process_form.php"  >
  <input type='hidden' id="variant" name='variant' value="dealSearch" />
  <p>Please enter permit id</p>
  <input class="textfield" type='text' id="dealSearchID" name='dealSearchID' value=""/>
  <input class="order-button" type='submit' name='searchDeal' value='searchDeal'>
  </form>
FORM;
}

// displays the bank loan approval form
function bankLoanApproval() {
  echo <<<"FORM"
  <h2>Bank Loan Approval</h2>
  <form class='shop-form' method='post' action="process_form.php"  >
  <input type='hidden' id="variant" name='variant' value="bank" />
  <p>Decision (Please enter Approved or Declined)</p>
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
  </form>

  <h2>Search for a Permit</h2>
  <form class='shop-form' method='post' action="process_form.php"  >
  <input type='hidden' id="variant" name='variant' value="permitSearch" />
  <p>Please enter permit id</p>
  <input class="textfield" type='text' id="permitSearchID" name='permitSearchID' value=""/>
  <input class="order-button" type='submit' name='searchPermit' value='searchPermit'>
  </form>
FORM;
}

// adds deal status to blockchain.
function updateDealStatus($decision, $address) {
    // Generates block data
    $date = getDateTime(); 
    $data = [
      'propertyOutcome' => $address,
      'decision' => $decision,
    ];
    $block = [
      'index' => $_SESSION['index'],
      'date' => $date,
      'previousHash' => $_SESSION['previousHash'],
      'data' => $data,
    ];
    // Creates hash of the block data
    $hash = createHash($block);
    // Adds the hash to the block data
    $block['hash'] =  $hash;
    // Adds block to blockchain
    addBlock($hash, $block);
    return $hash;
}

// uploads the file
function uploadFile($file) {
  $targetFolder = "../uploads/";
  $targetFolder = $targetFolder . basename($hashedFile);
  $fileType = $_FILES['design']['type'];
  if ($fileType == "application/pdf") {
    if(move_uploaded_file($_FILES['design']['tmp_name'], $targetFolder)) {
        echo "The file ". basename( $_FILES['design']['name']). " is uploaded" . "<br>";
      } else {
        echo "<br>";
        echo "Problem uploading file";
        echo "<br>";
      }   
  } else {
     echo "You may only upload PDFs.<br>";
  }
}

// Creates a Seller Block.
// Returns the generated hash as the permit application ID.
function createSellerBlock() {
  // create genesis block if required. 
  if ($_SESSION['index'] == 0 ) {
    createGenesisBlock();
  }
  // Generates block data
    $date = getDateTime(); 
    $data = [
      'property' => $_SESSION['propertyAddress'],
      'owner' => $_SESSION['ownerDetails'],
      'design' => $_SESSION['buildingDesign'], 
      'licence' => $_SESSION['licence'],
    ];
    $block = [
      'index' => $_SESSION['index'],
      'date' => $date,
      'previousHash' => $_SESSION['previousHash'],
      'data' => $data,
    ];
        // unsets all temporarily used session data. 
        unset($_SESSION['propertyAddress']);
        unset($_SESSION['ownerDetails']);
        unset($_SESSION['buildingDesign']);
        unset($_SESSION['licence']);
    // Creates hash of the block data
    $hash = createHash($block);
    // Adds the hash to the block data
    $block['hash'] =  $hash;
    // Adds block to blockchain
    addBlock($hash, $block);
    return $hash;
  }

// Creates an Authority Block with the passed details. 
function createAuthorityBlock() {
  // create genesis block if required.
  if ($_SESSION['index'] == 0 ) {
    createGenesisBlock();
  }
  // Generates block data
    $date = getDateTime();
    $data = [
      'decision' => $_SESSION['decision'],
      'property' => $_SESSION['property'],
    ];
    $block = [
      'index' => $_SESSION['index'],
      'date' => $date,
      'previousHash' => $_SESSION['previousHash'],
      'data' => $data,
    ];
        // unsets all temporarily used session data. 
        unset($_SESSION['decision']);
        unset($_SESSION['property']);
    // Creates hash of the block data
    $hash = createHash($block);
    // Adds the hash to the block data
    $block['hash'] =  $hash;
    // Adds block to blockchain
    addBlock($hash, $block);
  
}

// Creates a Buyer Block with the passed details. 
// Returns the generated hash as the Loan Application ID.
function createBuyerBlock() {
  // create genesis block if required.
  if ($_SESSION['index'] == 0 ) {
    createGenesisBlock();
  }
  // Generates block data
    $date = getDateTime();
    $data = [
      'name' => $_SESSION['name'],
      'DOB' => $_SESSION['DOB'],
      'currentAddress' => $_SESSION['currentAddress'],
      'number' => $_SESSION['number'],
      'employer' => $_SESSION['employer'],
      'income' => $_SESSION['income'],
      'propertyAddress' => $_SESSION['propertyAddress'],
      'loanAmount' => $_SESSION['loanAmount'],
    ];
    $block = [
      'index' => $_SESSION['index'],
      'date' => $date,
      'previousHash' => $_SESSION['previousHash'],
      'data' => $data,
    ];
    // unsets all temporarily used session data. 
    unset($_SESSION['name']);
    unset($_SESSION['DOB']);
    unset($_SESSION['currentAddress']);
    unset($_SESSION['number']);
    unset($_SESSION['employer']);
    unset($_SESSION['income']);
    unset($_SESSION['propertyAddress']);
    unset($_SESSION['loanAmount']);
    // Creates hash of the block data
    $hash = createHash($block);
    // Adds the hash to the block data
    $block['hash'] =  $hash;
    // Adds block to blockchain
    addBlock($hash, $block);
    return $hash;
  
}

// Creates a Bank Block with the passed String. 
function createBankBlock() {
  // create genesis block if required.
  if ($_SESSION['index'] == 0 ) {
    createGenesisBlock();
  }
  // Generates block data
    $date = getDateTime();
    $data = [
      'decision' => $_SESSION['decision'],
      'name' => $_SESSION['name'],
      'currentAddress' => $_SESSION['currentAddress'],
      'number' => $_SESSION['number'],
      'DOB' => $_SESSION['DOB'],
    ];
    $block = [
      'index' => $_SESSION['index'],
      'date' => $date,
      'previousHash' => $_SESSION['previousHash'],
      'data' => $data,
    ];
        // unsets all temporarily used session data. 
        unset($_SESSION['decision']);
        unset($_SESSION['customerName']);
        unset($_SESSION['currentAddress']);
        unset($_SESSION['number']);
        unset($_SESSION['DOB']);
    // Creates hash of the block data
    $hash = createHash($block);
    // Adds the hash to the block data
    $block['hash'] =  $hash;
    // Adds block to blockchain
    addBlock($hash, $block);
    return $hash;
  
}

// Returns a SHA256 Hash of the passed array.
function createHash($block) {
  $hash = hash('sha256', json_encode($block), false);
  return $hash;
}

// Adds block to Blockchain/List
function addBlock($hash, $block) {
  $_SESSION['previousHash'] = $hash;
  $_SESSION['blockchain'][$_SESSION['index']][$_SESSION['block']] = $block;
  $_SESSION['index']++;
  // Outputs the blockchain to csv file for teacher's ease.
  blockchainOutput($block);
}

// Creates a genesis block.
function createGenesisBlock() {
    $date = getDateTime();
    $previousHash = 0;
    $data = "Genesis Block";
    $block = [
      'index' => 0,
      'date' => $date,
      'previousHash' => $previousHash,
      'data' => $data,
    ];
    $hash = createHash($block);
    $block['hash'] =  $hash;
    addBlock($hash, $block);
}

// Gets current date time() 
function getDateTime() {
  date_default_timezone_set('Australia/Melbourne');
  $date = date('d/m/y h:i:s a', time());
  return $date;
}

// Writes out the newly created block to a csv file.
function blockchainOutput($block) {
    $block1 = json_encode($block)."\n";
    file_put_contents('blockchain_output.txt', $block1, FILE_APPEND | LOCK_EX);
}



