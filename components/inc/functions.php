<?php 

    function formatBetragCurrency($betrag){
        if (is_numeric($betrag)) {
            // Formatieren des Betrags mit zwei Dezimalstellen und deutschem Format (Komma als Dezimaltrennzeichen)
            return number_format((float)$betrag, 2, ',', '.').' '.'€';
        } else {
            return "0€";  // Falls der Betrag keine gültige Zahl ist
        }
    }

    function shortenComment($kommentar,$did){
        require "../components/database/db_connect.php"; /* Fehlerprüfen */

        if (!isset($did) || !is_numeric($did)) {
            return "Ungültige ID";  // Überprüfen, ob $did eine gültige ID ist
        }

        $zaehler_comment = strlen($kommentar);

        if ($zaehler_comment > 25) {
            // SQL-Abfrage vorbereiten
            $sql_comshort = "SELECT SUBSTRING(kommentar, 1, 22) as short_comment FROM downloads WHERE id = $did";
            $rescoSh = mysqli_query($connect, $sql_comshort);

            if ($rescoSh) {
                $rowcoSh = mysqli_fetch_assoc($rescoSh);
                if ($rowcoSh && !empty($rowcoSh['short_comment'])) {
                    $comment_short = $rowcoSh['short_comment'] . ' (...)';
                } else {
                    $comment_short = "Kein Kommentar gefunden";
                }
            } else {
                $comment_short = "Fehler bei der SQL-Abfrage: " . mysqli_error($connect);
            }
        } else {
            $comment_short = $kommentar;
        }
        // echo $comment_short;
        if (!empty($kommentar)) {
            return $comment_short;
        } else {
            return "Ungültige Eingabe";
        }
    }

    function formatUpdateDate($update_date){
        // $updateNewDatee = date("d.m.Y H:i", strtotime($rowAAF['update_date']));
        $updateNewDatee = date("d.m.Y, H:i", strtotime($update_date));

        if (!empty($update_date)) {
            return $updateNewDatee;
        } else {
            return "Ungültige Eingabe";
        }
    }
    function formatCreateDate($create_date){
        // $updateNewDatee = date("d.m.Y H:i", strtotime($rowAAF['update_date']));
        $createNewDatee = date("d.m.Y, H:i", strtotime($create_date));

        if (!empty($create_date)) {
            return $createNewDatee;
        } else {
            return "Ungültige Eingabe";
        }
    }

    function formatCreateDateJD($create_date){
        // $updateNewDatee = date("d.m.Y H:i", strtotime($rowAAF['update_date']));
        $createNewDatee = date("d.m.Y", strtotime($create_date));

        if (!empty($create_date)) {
            return $createNewDatee;
        } else {
            return "Ungültige Eingabe";
        }
    }

    function formatKundeVollNameCompany($vorname,$nachname, $firma){
        // Überprüfen, ob Vorname, Nachname und Firma angegeben sind
      if (!empty($firstName) && !empty($lastName) && !empty($firma) ) {
          return "$vorname $nachname ($firma)";
      } elseif (!empty($vorname) && !empty($nachname) && !empty($firma)) {
          return "$vorname $nachname ($firma)";
      } else {
          return "Ungültige Eingabe";
      }
    }
    function formatKundeVollName($vorname,$nachname){
        // Überprüfen, ob Vorname, Nachname und Firma angegeben sind
      if (!empty($firstName) && !empty($lastName) ) {
          return "$vorname $nachname";
      } elseif (!empty($vorname) && !empty($nachname)) {
          return "$vorname $nachname";
      } else {
          return "Ungültige Eingabe";
      }
    }

    /* ---- Dateigröße aus dem Dateisystem herausfiltern ---- */
    function filesize_formatted($datei)
    {
        if (!file_exists($datei)) {
            return 'Unbekannt';
        }
            
        $size = filesize($datei);
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
            
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }
    /* ---- Dateigröße aus dem Dateisystem herausfiltern ---- */

    /* ---- Dateigröße aus Datenbank herausfiltern ---- */
    function formatFileSizeNEW($bytes)
    {
        if (!is_numeric($bytes)) {
            return "Invalid size";
        }
        $units = ["Bytes", "KB", "MB", "GB", "TB"];
        $power = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
        $formattedSize = number_format($bytes / pow(1024, $power), 2);
        return $formattedSize . " " . $units[$power];
    }
    /* ---- Dateigröße aus Datenbank herausfiltern ---- */

    /* ---- FlashMessage-System für diverse Meldungen ---- */
    function setFlashMessage($type, $message) {
         // Sicherstellen, dass die Session gestartet wird
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Überprüfen, ob die 'flash_messages' in der Session existiert
    if (!isset($_SESSION['flash_messages'])) {
        $_SESSION['flash_messages'] = [];
    }

    // Flash-Nachricht setzen
    $_SESSION['flash_messages'][$type] = $message;
    }
        
    function getFlashMessage($type) {
    session_start();
    if (isset($_SESSION['flash_messages'][$type])) {
        $msg = $_SESSION['flash_messages'][$type];
        unset($_SESSION['flash_messages'][$type]);
        return '<div class="' . $type . '">' . $msg . '</div>';
    }
        return '';
    }
    /* ---- FlashMessage-System für diverse Meldungen ---- */

    function DatumAusgabe($getDate){
        $newDate = date("d.m.Y", strtotime($getDate));
        return $newDate;
    }
    function TimeAusgabe($getTime){
        $newTime = date("H:i", strtotime($getTime));
        return $newTime;
    }

?>