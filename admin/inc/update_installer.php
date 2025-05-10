<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../../components/database/db_connect.php';

// Parameter prüfen
if (!isset($_GET['projektname']) || !isset($_GET['version']) || !isset($_GET['download_url'])) {
    die("❌ Ungültiger Aufruf – Parameter fehlen.");
}

$projektname = $_GET['projektname'];
$new_version = $_GET['version'];
$download_url = $_GET['download_url'];

// Basisverzeichnis korrekt setzen (ein Verzeichnis über admin/)
$base_dir = dirname(__DIR__, 2); // war: dirname(__DIR__)

// Optional: Schutz vor Ausführung im falschen Projekt
$expected_dir = strtolower(str_replace(' ', '', $projektname)); // "Agency 2025" → "agency2025"
echo "DEBUG: basename(base_dir) = " . basename($base_dir) . "<br>";
echo "DEBUG: expected_dir = " . $expected_dir . "<br>";

// Stelle sicher, dass der Vergleich der Verzeichnisse auch bei Groß-/Kleinschreibung korrekt funktioniert
if (strtolower(basename($base_dir)) !== $expected_dir) {
    die("❌ Sicherheitsabbruch: Projektverzeichnis stimmt nicht mit Projektnamen überein.");
}

// Installationsverzeichnis ermitteln
// $installationsverzeichnis = $_SERVER['DOCUMENT_ROOT']; // Wurzelverzeichnis des Webservers
// Alternativ (falls relative Pfade verwendet werden):
$installationsverzeichnis = dirname(__DIR__, 2); // Für das Verzeichnis zwei Ebenen über admin/

echo "Installationsverzeichnis: $installationsverzeichnis<br>";

// Zielpfade definieren
$update_zip = $installationsverzeichnis . '/update/update.zip';
$update_dir = $installationsverzeichnis . '/';
$backup_dir = $installationsverzeichnis . '/backups/' . date('Ymd_His');

// Sicherstellen, dass Updateverzeichnis existiert
if (!is_dir(dirname($update_zip))) {
    mkdir(dirname($update_zip), 0777, true);
}

// Update-Datei herunterladen
echo "⬇️ Lade Update-Datei herunter...<br>";
$zipData = @file_get_contents($download_url);
if (!$zipData) die("❌ Download fehlgeschlagen: Datei nicht gefunden oder Serverfehler.");

file_put_contents($update_zip, $zipData);

// Backup erstellen
echo "📦 Erstelle Backup...<br>";
if (!is_dir($backup_dir)) mkdir($backup_dir, 0777, true);
@copy($installationsverzeichnis . '/config.php', $backup_dir . '/config.php');

// ZIP entpacken
$zip = new ZipArchive();
if ($zip->open($update_zip) === TRUE) {
    echo "📂 Entpacke Update...<br>";
    $zip->extractTo($update_dir);
    $zip->close();
    unlink($update_zip);

    // Versionsnummer aktualisieren
    echo "📝 Aktualisiere Versionsnummer...<br>";
    $stmt = $connect->prepare("UPDATE portfolio_settings SET site_version = ? WHERE id = 3");
    $stmt->bind_param("s", $new_version);
    if ($stmt->execute()) {
        echo "<strong style='color:green;'>✅ Update erfolgreich auf Version: $new_version</strong><br>";
        echo "🎉 Das System ist nun aktuell.<br>";
    } else {
        echo "❌ Fehler beim Versionsupdate: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "❌ ZIP-Fehler beim Entpacken!";
}
?>