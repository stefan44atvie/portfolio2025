<?php 
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);    

    require ('../components/database/db_connect.php');
    require "../components/inc/sessions.php";
    include "../components/inc/timezone.php";
    include "../components/inc/functions.php";

    if(isset($_SESSION["admin"]) ){
        header("Location: dashboard.php");
      }

    /* ---- Login-Ablauf ---- */
    if (isset($_POST["btn-login"])) {
      $error = false;
      
      // Eingabewerte bereinigen
      $email = cleanInput($_POST["login_email"]);
      $password = cleanInput($_POST["login_password"]);
  
      // Überprüfen der E-Mail-Adresse
      if (empty($email)) {
          $error = true;
          $emailError = "Bitte geben Sie Ihre email-Adresse ein.";
          setFlashMessage('error', 'Bitte geben Sie Ihre email-Adresse ein.');

      } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $error = true;
          $emailError = "Bitte geben Sie eine korrekte E-Mail-Adresse ein!";
          setFlashMessage('error', 'Bitte geben Sie eine korrekte E-Mail-Adresse ein!');
      }
  
      // Überprüfen des Passworts
      if (empty($password)) {
          $error = true;
          $passError = "Bitte geben Sie ein Passwort ein!";
          setFlashMessage( 'error', 'Bitte geben Sie ein Passwort ein!');
      }
  
      // Wenn keine Fehler vorliegen, fahre fort
      if (!$error) {
          // Verwende Prepared Statements, um SQL-Injection zu vermeiden
          $stmt = $connect->prepare("SELECT * FROM portfolio_users WHERE email = ?");
          $stmt->bind_param("s", $email); // "s" für string
          $stmt->execute();
          $result = $stmt->get_result();
          $row = $result->fetch_assoc();
  
          // Überprüfen, ob der Benutzer existiert und das Passwort stimmt
          if ($row) {
              // Überprüfen, ob das Passwort korrekt ist
              if (password_verify($password, $row["password"])) {
                // Session setzen
                if ($row["status"] == "admin") {
                    $_SESSION["admin"] = $row["id"];
                } else if ($row["status"] == "user") {
                    $_SESSION["user"] = $row["id"];
                }
            
                // Cookie setzen
                $cookie_id = $row["id"];
                setcookie("user", $cookie_id, time() + 3600, "/", "", isset($_SERVER["HTTPS"]), true);
            
                // Weiterleitung und Beenden
                header("Location: dashboard.php");
                exit;
            
            } else {
                // Nur wenn das Passwort nicht stimmt!
                $passError = "Falsches Passwort!";
                setFlashMessage('error', 'Falsches Passwort!');
            }
          } else {
              $emailError = "Benutzer existiert nicht!";
              setFlashMessage('error', 'Benutzer existiert nicht!');

          }
  
          $stmt->close(); // Stelle sicher, dass die vorbereitete Abfrage geschlossen wird
      }
  }
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

  <!-- Title -->
  <title>My portfolio page</title>
</head>
<body class="">
   <div id="login_screenwindow">
        <div id="login_area">
            <div class="login_titlebox">
                <h1 class="login_titletext">Login Portfolio 2025</h1>
            </div>
            <div class="textbox">
                <p class="login_text">
                    Logge dich mit deinem Benutzernamen und dem dazugehörigen Passwort ein</h1>
                </p>
            </div>
            <form class="w-100 " method="post" action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']) ; ?>" autocomplete="off">
                <div id="portfolio_loginform">
                    <div id="port_loginname">
                        <input type="email" autocomplete="off" name="login_email" id="login_email" class="form-control me-1" placeholder="Ihre email-Addresse" value="<?php echo $email;?>">
                    </div>
                    <div id="port_password">
                        <input type="password" name="login_password" id="login_password" class="form-control" placeholder="Ihr Passwort" maxlength="64" />
                    </div>
                    <div id="submit_loginbutton">
                        <button class="btn btn-block btn-success mt-1 w-100" type="submit" name="btn-login" id="btn-login">Login</button>
                    </div>
                    <div id="fehlermeldungen">
                        <?php 
                            echo getFlashMessage('success');
                            echo getFlashMessage('error');
                            echo getFlashMessage('alert');
                        ?>
                    </div>
                </div>
            </form>
        </div>
   </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="components/inc/menu_active.js"></script>
</body>
</html>