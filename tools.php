<?php
  session_start();
  error_reporting( E_ERROR | E_WARNING | E_PARSE);
  $alerts = getAlertsFromCSV();

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

  $index = 0;
  $previousHash = "";
  $blockchain[] = "";


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

// Creates a Seller Block with the passed details. 
// Returns the generated hash as the permit application ID.
function createSellerBlock($property, $owner, $design, $licence) {
  if ($index !== 0) {
    $date = getDateTime();
    $data = [
      'property' => $property,
      'owner' => $owner,
      'design' => $design,
      'licence' => $licence,
    ];
    $block = [
      'index' => $index,
      'date' => $date,
      'previousHash' => $previousHash,
      'data' => $data,
    ];
    $hash = createHash($block);
    $block += 'hash' => $hash;
    addBlock($hash, $block);
    return $hash;
  }
}


// Creates an Authority Block with the passed details. 
function createAuthorityBlock($decision, $property) {
  if ($index !== 0) {
    $date = getDateTime();
    $data = [
      'decision' => $decision,
      'property' => $property,
    ];
    $block = [
      'index' => $index,
      'date' => $date,
      'previousHash' => $previousHash,
      'data' => $data,
    ];
    $hash = createHash($block);
    $block = array_merge('hash' => $hash);
    addBlock($hash, $block);
  }
}

// Creates a Buyer Block with the passed details. 
// Returns the generated hash as the Loan Application ID.
function createBuyerBlock($name, $DOB, $currentAddress, $number, 
                          $employer, $income, $propertyAddress, $loanAmount) {
  if ($index !== 0) {
    $date = getDateTime();
    $data = [
      'name' => $name,
      'DOB' => $DOB,
      'currentAddress' => $currentAddress,
      'number' => $number,
      'employer' => $employer,
      'income' => $income,
      'propertyAddress' => $propertyAddress,
      'loanAmount' => $loanAmount,
    ];
    $block = [
      'index' => $index,
      'date' => $date,
      'previousHash' => $previousHash,
      'data' => $data,
    ];
    $hash = createHash($block);
    $block = array_merge('hash' => $hash);
    addBlock($hash, $block);
    return $hash;
  }
}

// Creates a Bank Block with the passed String. 
function createBankBlock($decision, $name, $currentAddress, $number, $DOB) {
  if ($index !== 0) {
    $date = getDateTime();
    $data = [
      'decision' => $decision,
      'name' => $name,
      'currentAddress' => $currentAddress,
      'number' => $number,
      'DOB' => $DOB,
    ];
    $block = [
      'index' => $index,
      'date' => $date,
      'previousHash' => $previousHash,
      'data' => $data,
    ];
    $hash = createHash($block);
    $block = array_merge('hash' => $hash);
    addBlock($hash, $block);
    return $hash;
  }
}

// Returns a SHA256 Hash of the passed array.
function createHash($block) {
  $hash = hash('sha256', $block.serialize(), false);
  return $hash;
}

// Used to get the generic info of each block.
function getBlockBasics() {
  if($index === 0) {
    createGenisisBlock();
    $string = "Block could not be added, please try again";
    return $string;
    } else {
    $date = getDateTime();
  }
  //Previous Hash
}

// Adds block to Blockchain/List
function addBlock($hash, $block) {
 $blockchain.add($hash => $block);
 $previousHash = $hash;
 $index++;
}

// Creates a genesis block.
function createGensisBlock() {
  if ($index === 0) {
    $date = getDateTime();
    $previousHash = 0;
    $data = "Genesis Block";
    // $block = $index . $date . $previousHash . $data;
    $block = [
      'index' => $index,
      'date' => $date,
      'previousHash' => $previousHash,
      'data' => $data,
    ];
    $hash = createHash($block);
    $block = array_merge('hash' => $hash);
    addBlock($hash, $block);
  }
}

// Gets current date time() 
function getDateTime() {
  date_default_timezone_set('Australia/Melbourne');
  $date = date('d/m/y h:i:s a', time());
  return $date;
}

// Builds array of alerts from CSV File
function getAlertsFromCSV() {
  $alerts=[];
  if( ($fp = fopen('alerts.txt','r')) && flock($fp, LOCK_SH) ) {
    if (($headings = fgetcsv($fp)) !== false) {
      while ( $cells = fgetcsv($fp) ) {
        $numCols = count($cells);
        for ($c=1; $c<$numCols; $c++) {
          $alerts[$cells[0]][$headings[$c]] = $cells[$c];
        }
        $temp=explode('|', $alerts[$cells[0]]['Temperature'] );
        $humidity=explode('|', $alerts[$cells[0]]['Humidity'] );
        $date=explode('|', $alerts[$cells[0]]['Date'] );
        $time=explode('|', $alerts[$cells[0]]['Time'] );
      }
    }
    flock($fp, LOCK_UN);
    fclose($fp);
    return($alerts);
  }
}

// Builds table rows from data collected from CSV file.
function tableModule() {
  $alerts = getAlertsFromCSV();
  foreach ($alerts as $alert => $range) {
  $date = $range['Date'];
  $time = $range['Time'];
  $temp = $range['Temperature'];
  $humidity = $range['Humidity'];
  echo <<<"TABLE"
  <tr>
    <td class="table-row">$date</td>
    <td class="table-row">$time</td>
    <td class="table-row">$temp&degC</td>
    <td class="table-row">$humidity%</td>
  </tr>
TABLE;
}
}