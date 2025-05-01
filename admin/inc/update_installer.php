<?php
// Fehler anzeigen (für Debugzwecke – im Livebetrieb ggf. deaktivieren)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// DB-Verbindung einbinden
require_once '../../components/database/db_connect.php';

// Parameter validieren
if (!isset($_GET['download_url']) || !isset($_GET['version'])) {
    die("❌ Ungültiger Aufruf – download_url oder version fehlt.");
}

$download_url = $_GET['download_url'];
$new_version = $_GET['version'];

// Verzeichnisse festlegen
$base_dir = dirname(__DIR__, 2);                      // /var/www/html/portfolio2025
$update_dir = $base_dir . '/';                        // Zielverzeichnis
$update_zip = $base_dir . '/update/update.zip';       // ZIP-Datei
$backup_dir = $base_dir . '/backups/' . date('Ymd_His'); // z. B. /backups/20250430_193000

// Sicherstellen, dass das Update-Verzeichnis existiert
if (!is_dir(dirname($update_zip))) {
    mkdir(dirname($update_zip), 0777, true);
}

// Download der Update-Datei
echo "⬇️ Lade Update-Datei herunter...<br>";
$zipData = file_get_contents($download_url);
if ($zipData === false) {
    die("❌ Fehler beim Herunterladen der ZIP-Datei.");
}

file_put_contents($update_zip, $zipData);

// Optional: Backup erstellen (z. B. von config-Dateien, Templates etc.)
echo "📦 Erstelle Backup...<br>";
if (!is_dir($backup_dir)) {
    mkdir($backup_dir, 0777, true);
}
// Beispiel: Konfigurationsdateien sichern
copy($base_dir . '/config.php', $backup_dir . '/config.php');

// ZIP öffnen und entpacken
$zip = new ZipArchive();
if ($zip->open($update_zip) === TRUE) {
    echo "📂 Entpacke Update...<br>";
    $zip->extractTo($update_dir);
    $zip->close();
    unlink($update_zip); // ZIP löschen nach erfolgreichem Update
    echo "📁 Dateien nach dem Entpacken:<br>";
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($update_dir));
    foreach ($rii as $file) {
        if (!$file->isDir()) {
            echo $file->getPathname() . "<br>";
        }
    }

    // Datenbankversion aktualisieren
    echo "📝 Aktualisiere Versionsnummer in der Datenbank...<br>";
    $stmt = $connect->prepare("UPDATE portfolio_settings SET site_version = ? WHERE id = 3");
    $stmt->bind_param("s", $new_version);
    
    if ($stmt->execute()) {
        echo "✅ Update erfolgreich abgeschlossen! Neue Version: $new_version<br>";
    } else {
        echo "❌ Fehler beim Aktualisieren der Datenbank: " . $stmt->error . "<br>";
    }

    $stmt->close();
} else {
    echo "❌ Fehler beim Öffnen der ZIP-Datei.";
}
?>