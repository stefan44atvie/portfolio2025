<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);    

    require ('../components/database/db_connect.php');
    require "../components/inc/sessions.php";
    include "../components/inc/timezone.php";
    include "../components/inc/functions.php";

    if(!isset($_SESSION["admin"])){
        header("Location: index.php");
      }

     /* ---- Projektname/Version ---- */
     $sql_settings = "select * from portfolio_settings";
     $resSET = mysqli_query($connect,$sql_settings);
     $rowSET = mysqli_fetch_assoc($resSET);
     $projektname = $rowSET['projektname'];
     $app_version = $rowSET['site_version'];
     /* ---- Projektname/Version ---- */
 

?>

<!DOCTYPE html>
<html lang="de">
<head>
  <!-- Meta Tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS Files Links -->
  <link rel="stylesheet" href="../components/css/portfolio_general.css">
  <link rel="stylesheet" href="../components/css/portfolio_fonts.css">
  <link rel="stylesheet" href="../components/css/portfolio_admin.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- CSS Files Links -->
  <!-- Google tag (gtag.js) -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-5DCMVFF9F1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-5DCMVFF9F1');
    </script> -->
 <!-- Google tag (gtag.js) -->

  <!-- Title -->
  <title>My portfolio page</title>
</head>
<body>
    <div class="dasboard_menu">
        <?php include('inc/mainmenu_user.php'); ?>
    </div>
    <div id="port_dashboard">
        <h1>Dashboard Portfolio Aktuell</h1>
        Servus, hier kannst du in aller Schnelle überprüfen, ob für das aktuelle Portfolio ein Update vorliegt, oder nicht. Sollte eines angezeigt werden, kannst du dies sofort installieren... Juhuu
        <?php echo $_SESSION['admin']; ?>
        <div id="updatecheck_text">
            <a class="standard_text">
                <span class="bold_text">Version</span>: 
                <span id="app-version" data-projektname="<?php echo $projektname; ?>" data-version="<?php echo $app_version; ?>"><?php echo $app_version; ?> <span id="updateMessage"></span>
                </span>
            </a>       
        </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="components/inc/menu_active.js"></script>
  <script src="../components/scripts/update_check.js"></script>
</body>
</html>