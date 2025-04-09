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
<!-- /* Google tag (gtag.js) */
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5DCMVFF9F1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-5DCMVFF9F1');
    </script>
 /* Google tag (gtag.js) */ -->

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
        <div id="cta_button" class=" fixed-bottom">
            <a class="btn btn-primary btn-lg btn-rounded" href="#portfolio_projects" role="button" data-mdb-ripple-init>Check my
        projects<i class="fas fa-angle-down ms-2"></i></a>
        </div>
   </div>
   <div id="portfolio_offers">
        <div class="portfolio_tile">
            <h4 class="title_text">
                My offers
            </h4>
        </div>
        <div class="portfolio_text">
            <p class="pf_text">
                As a dedicated FullStack Web Developer, I am committed to meeting your requirements and delivering an exceptional and responsive website tailored to your business needs.
            </p>
        </div>     
        <div class="offers_content">
            <div id="box_fullstack">
                <h3 class="box_title">Fullstack Webdevelopment</h3>
                <p class="pf_text">
                The forthcoming website will meet all the necessary requirements and can be displayed on all mobile devices.
                </p>
            </div>
            <div id="box_socialmedia">
                <h3 class="box_title">Social Media Management</h3>
                <p class="pf_text">
                Digitale Seele assumes control of the playback of Texts and Media through various Social Media Platforms.
                </p>
            </div>
            <div id="box_photo">
                <h3 class="box_title">Photographer</h3>
                <p class="pf_text">
                    If required, I can personally capture all the necessary images for your website using my own equipment. You can view my photographic work on <a href="https://www.sfr-fotografie.at" target="_blank">this website</a>. All the images on this website were taken by me.                
                </p>
            </div>
        </div>
             
   </div>
   <div id="portfolio_myskills">
        <div class="portfolio_tile">
            <h4 class="title_text">
                My skills
            </h4>
        </div>
   </div>
   <div id="portfolio_projects">
        <div class="portfolio_tile">
            <h4 class="title_text">
                My projects
            </h4>
        </div>
   </div>
   <div id="portfolio_aboutme">
        <div class="portfolio_tile">
            <h4 class="title_text">
                About me
            </h4>
        </div>
   </div>
   <div id="portfolio_contact">
   <div class="portfolio_tile">
            <h4 class="title_text">
                contact me
            </h4>
        </div>
   </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="./scripts.js"></script>
</body>
</html>