<?php
  session_start();
  error_reporting( E_ERROR | E_WARNING | E_PARSE);

  function debugModule() {
    echo "\n\n<pre id='debug'>";
    print_r($_POST);
    print_r($_SESSION);
    print_r($_REQUEST);
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
    "Alice" => array('passwordA', 'seller'),
    "Bob" => array('passwordB', 'authority'),
    "Carol" => array('passwordC', 'buyer'),
    "Daniel" => array('passwordD', "bank")
  );

  function logIO() {
    global $users;
    if (isset($_SESSION['user'])) {
      unset($_SESSION['user']);
    } else {
      if (!empty($_REQUEST['user']) && !empty($_REQUEST['password']) && !empty($_REQUEST['variant'])) {
        if (key_exists($_REQUEST['user'], $users)) {
          if (strcmp($users[$_REQUEST['user']], 
              $_REQUEST['password'], $_REQUEST['variant']) === 0) {   
                echo "This worked";
                // break this up into different string compares.
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
<!-- <img class='logo-head' src='../../media/logo.jpg'> -->
  <h2 class='company-name'>Homelink</h2>
  <a href='index.php'>
    <!-- img used for educational purposes only, note this will be relpaced with a new logo -->
    <!-- dilayorganci, 2017. Home Link. Free icons for everything - noun project. Available at: https://thenounproject.com/icon/home-link-815698/ [Accessed February 6, 2022]. -->
  <img class='logo' src='../../media/homelink.png ' alt='The homelink Company Logo' height="150">
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
        <li><a href="./members.php">Members</a></li>
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
        <li><a href="./members.php">Members</a></li>
        <li><input type='button' class='login-btn' id='login-btn' onclick='toggleLogin()' value='Login' /></li>
      </ul>
      <form class='login' id=login method='post' hidden>
        <input type=hidden id='status' name='status' value='Login' />
        <input type='text' id="user" name='user' placeholder='username' required />
        <input type='text' id="password" name='password' placeholder='password' required />
        <fieldset class="login-types">
        <label>User Type</label>
        <input type='radio' id="seller" value='seller' name='variant' checked="checked" required />
        <label for='seller'>Seller</label>
        <input type='radio' id="authority" value='authority' name='variant' />
        <label for='authority'>Authority</label>
        <input type='radio' id="buyer" value='buyer' name='variant' />
        <label for='buyer'>Buyer</label>
        <input type='radio' id="bank" value='bank' name='variant' />
        <label for='bank'>Bank</label>
        </fieldset>
        <input class='btn' type='SUBMIT' value='Login' />
      </form>
      
    </nav>
NAV;
  }
}

// Need to amend to current project. Maybe display the search function and relevant form.
function membersContent() {
  if(isset($_SESSION['user'])) {
    echo <<<"MEMBER"
      <main>
        <h1>Members Only Page</h1>
        <p><img src='website-under-construction.png' alt='Website Under Construction' /></p>
MEMBER;
  } else {
    echo <<<"MEMBER"
    <main>
      <h1>Members Only Page</h1>
      <p>This page is for members only</p>
MEMBER;
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
      'design' => $_SESSION['buildingDesign'], // Change design to pdf
      'licence' => $_SESSION['licence'],
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
  blockchainOutput();
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

function blockchainOutput() {
  foreach($_SESSION['blockchain'] as $chain => $session) {
  $block = $session['index']."\n";
  $block .= $session['block']."\n";
  file_put_contents('blockchain_output.txt', $block, FILE_APPEND | LOCK_EX);
  }
}

function errorMessage() {
  echo <<<"REDIRECT"
  <h3>Something went wrong!</h3>
  <a href="index.php" class="nav_link">Return to homepage</a>
</section>
REDIRECT;
}



