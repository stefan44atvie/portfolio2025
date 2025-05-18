<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../../components/database/db_connect.php';

// 🔧 Logging-Funktion
function logUpdate($message) {
    $logfile = __DIR__ . '/../../logs/update_log_' . date('Ymd') . '.log';
    $timestamp = date('[Y-m-d H:i:s]');
    file_put_contents($logfile, "$timestamp $message" . PHP_EOL, FILE_APPEND);
}

// 🔍 Parameter prüfen
if (!isset($_GET['projektname']) || !isset($_GET['version']) || !isset($_GET['download_url'])) {
    logUpdate("❌ Ungültiger Aufruf – Parameter fehlen.");
    die("❌ Ungültiger Aufruf – Parameter fehlen.");
}

$projektname = $_GET['projektname'];
$new_version = $_GET['version'];
$download_url = $_GET['download_url'];

logUpdate("🔄 Starte Update: Projekt=$projektname | Version=$new_version");

// 🔄 Projekt-Zuordnung
$projekt_map = [
    'Portfolio 2025' => 'portfolio2025',
];

if (!isset($projekt_map[$projektname])) {
    logUpdate("❌ Unbekannter Projektname: $projektname");
    die("❌ Unbekannter Projektname: $projektname");
}

// 🔐 Sicherheitsprüfung
$base_dir = dirname(__DIR__, 2);
$expected_dir = $projekt_map[$projektname];
$actual_dir = strtolower(basename($base_dir));

echo "DEBUG: basename(base_dir) = $actual_dir<br>";
echo "DEBUG: expected_dir = $expected_dir<br>";

if ($actual_dir !== strtolower($expected_dir)) {
    logUpdate("❌ Sicherheitsabbruch: Verzeichnis stimmt nicht mit Projekt überein.");
    die("❌ Sicherheitsabbruch: Projektverzeichnis stimmt nicht mit Projektnamen überein.");
}

// 📁 Verzeichnisse
$update_zip = $base_dir . '/update/update.zip';
$update_dir = $base_dir . '/';
$backup_dir = $base_dir . '/backups/' . date('Ymd_His');

echo "Installationsverzeichnis: $base_dir<br>";

if (!is_dir(dirname($update_zip))) mkdir(dirname($update_zip), 0777, true);

// ⬇️ Datei herunterladen
echo "⬇️ Lade Update-Datei herunter...<br>";
echo "Download-URL: $download_url<br>";
$zipData = @file_get_contents($download_url);
if (!$zipData) {
    logUpdate("❌ Fehler beim Herunterladen: $download_url");
    die("❌ Download fehlgeschlagen: Datei nicht gefunden oder Serverfehler.");
}
file_put_contents($update_zip, $zipData);
logUpdate("✅ ZIP erfolgreich heruntergeladen.");

// 📦 Backup
echo "📦 Erstelle Backup...<br>";
if (!is_dir($backup_dir)) mkdir($backup_dir, 0777, true);
@copy($base_dir . '/config.php', $backup_dir . '/config.php');
logUpdate("🗂 Backup erstellt: config.php");

// 📂 Entpacken
$zip = new ZipArchive();
if ($zip->open($update_zip) === TRUE) {
    echo "📂 Entpacke Update...<br>";
    $zip->extractTo($update_dir);
    $zip->close();
    unlink($update_zip);
    logUpdate("✅ ZIP entpackt und gelöscht.");

    // 🔁 Optional: Dateien gezielt verschieben/ersetzen
    $renameMap = [
        'admin/inc/update_installerRAS.php' => 'admin/inc/update_installer.php',
        // 'components/database/db_connect_web.php' => 'components/database/db_connect.php',
        // 'components/inc/check_remote_licenceWeB.php' => 'components/inc/check_remote_licence.php',
        // 'components/scripts/check_updateWEB.js' => 'components/scripts/check_update.js',
    ];

    foreach ($renameMap as $relQuelle => $relZiel) {
        $quelle = $base_dir . '/' . $relQuelle;
        $ziel = $base_dir . '/' . $relZiel;

        if (file_exists($quelle)) {
            if (file_exists($ziel)) {
                unlink($ziel);
                echo "🗑 Entferne alte Datei: $relZiel<br>";
                logUpdate("🗑 Alte Datei entfernt: $relZiel");
            }

            if (!is_dir(dirname($ziel))) {
                mkdir(dirname($ziel), 0777, true);
            }

            if (rename($quelle, $ziel)) {
                echo "✅ Datei ersetzt: $relQuelle → $relZiel<br>";
                logUpdate("🔁 Datei ersetzt: $relQuelle → $relZiel");
            } else {
                echo "❌ Fehler beim Verschieben: $relQuelle<br>";
                logUpdate("❌ Fehler beim Verschieben: $relQuelle");
            }
        } else {
            echo "⚠️ Datei nicht vorhanden: $relQuelle<br>";
            logUpdate("⚠️ Datei nicht gefunden: $relQuelle");
        }
    }

    // 📝 Versionsupdate in DB
    echo "📝 Aktualisiere Versionsnummer...<br>";
    $update_sql_map = [
        'portfolio' => ['table' => 'portfolio_settings', 'id' => 3],
    ];

    $db_info = $update_sql_map[$expected_dir];
    $stmt = $connect->prepare("UPDATE {$db_info['table']} SET site_version = ? WHERE id = ?");
    $stmt->bind_param("si", $new_version, $db_info['id']);

    if ($stmt->execute()) {
        echo "<strong style='color:green;'>✅ Update erfolgreich auf Version: $new_version</strong><br>";
        echo "🎉 Das System ist nun aktuell.<br>";
        logUpdate("✅ Versionsnummer in DB aktualisiert: $new_version");
    } else {
        echo "❌ Fehler beim Versionsupdate: " . $stmt->error;
        logUpdate("❌ Datenbankfehler: " . $stmt->error);
    }
    $stmt->close();
} else {
    echo "❌ ZIP-Fehler beim Entpacken!";
    logUpdate("❌ Fehler beim Öffnen des ZIP-Archivs.");
}
?>