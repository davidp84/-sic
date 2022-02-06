<?php
  session_start();
  error_reporting( E_ERROR | E_WARNING | E_PARSE);

  $alerts = getAlertsFromCSV();

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
