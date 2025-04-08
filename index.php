<?php 
// ini_set(option: 'display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
    include "components/inc/functions.php";
    
    // $mydate = "2025-09-02 20:35:00";

    // $mydateNew = DatumAusgabe($mydate);
    // $myTimeNew = TimeAusgabe($mydate);

?>

<!DOCTYPE html>
<html lang="de">
<head>
  <!-- Meta Tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS Files Links -->
  <link rel="stylesheet" href="components/css/portfolio_general.css">
  <link rel="stylesheet" href="components/css/portfolio_fonts.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <!-- Title -->
  <title>My Agency 2025</title>
</head>
<body class="genbody">
    <?php include('components/inc/mainmenu.php'); ?>
   <div id="portfolio_startscreen">
        <div id="pf_starttext1">
            <h2 class="pf_text1 display-4">Stefan Rüdenauer</h2>
        </div>
        <div id="pf_starttext2">
            <br>
            <h1 class="pf_text1 display-2 fw-bold text-uppercase">FullStack Web development</h1>
        </div>
        <div id="cta_button" class=" d-flex align-items-center w-100 justify-content-between px-5 mb-5 fixed-bottom">
        <a class="btn btn-primary btn-lg btn-rounded" href="#myprojects" role="button" data-mdb-ripple-init>Check my
        projects<i class="fas fa-angle-down ms-2"></i></a>
        </div>
   </div>
   <div id="portfolio_projects">

   </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="./scripts.js"></script>
</body>
</html>