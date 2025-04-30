<?php 
    // ini_set('display_errors', 1);
    // error_reporting(E_ALL);
    require "../components/inc/sessions.php";

    if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])&& !isset($_SESSION['interessent']) && !isset($_SESSION['superadmin'])) {
        header("Location: index.php");
        exit;
    }

    if(isset($_GET["logout"])){
        unset ($_SESSION["user"]);
        unset ($_SESSION["admin"]);
        unset ($_SESSION["interessent"]);
        unset ($_SESSION["superadmin"]);


        session_unset();
        session_destroy();
        header("Location: index.php");
        exit;

    }
?>