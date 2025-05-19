<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../../components/database/db_connect.php';

function logUpdate($message) {
    $logfile = __DIR__ . '/../../logs/update_log_' . date('Ymd') . '.log';
    $timestamp = date('[Y-m-d H:i:s]');
    file_put_contents($logfile, "$timestamp $message" . PHP_EOL, FILE_APPEND);
}

// Umgebung sicher erkennen
function isLocalhost() {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $host = $_SERVER['HTTP_HOST'] ?? '';
    return in_array($ip, ['127.0.0.1', '::1']) ||
           strpos($host, 'localhost') !== false ||
           strpos($host, '192.168.') === 0;
}

$umgebung = isLocalhost() ? 'lokal' : 'web';
logUpdate("🌍 Umgebung erkannt: $umgebung");

// Parameter prüfen
if (!isset($_GET['projektname'], $_GET['version'], $_GET['download_url'])) {
    logUpdate("❌ Ungültiger Aufruf – Parameter fehlen.");
    die("❌ Ungültiger Aufruf – Parameter fehlen.");
}

$projektname = $_GET['projektname'];
$new_version = $_GET['version'];
$download_url = $_GET['download_url'];

logUpdate("🔄 Starte Update: Projekt=$projektname | Version=$new_version");

// Projekt-Mappings
$projekt_map_lokal = [
    'Portfolio 2025' => 'portfolio2025',
];
$projekt_map_web = [
    'Portfolio 2025' => 'portfolio',
];
$projekt_map = ($umgebung === 'lokal') ? $projekt_map_lokal : $projekt_map_web;

if (!isset($projekt_map[$projektname])) {
    logUpdate("❌ Unbekannter Projektname: $projektname");
    die("❌ Unbekannter Projektname: $projektname");
}

// Verzeichnisse prüfen
$base_dir = dirname(__DIR__, 2);
$expected_dir = strtolower($projekt_map[$projektname]);
$actual_dir = strtolower(basename($base_dir));

logUpdate("📁 Base dir: $base_dir | Actual dir: $actual_dir | Expected dir: $expected_dir");

if ($actual_dir !== $expected_dir) {
    logUpdate("❌ Sicherheitsabbruch: Projektverzeichnis ($actual_dir) stimmt nicht mit erwartetem Namen ($expected_dir) überein.");
    die("❌ Sicherheitsabbruch: Projektverzeichnis stimmt nicht mit Projektnamen überein.");
}

// Pfade setzen
$update_zip = $base_dir . '/update/update.zip';
$update_dir = $base_dir . '/';
$backup_dir = $base_dir . '/backups/' . date('Ymd_His');

// Ausgabe
echo "Installationsverzeichnis: $base_dir<br>";
echo "⬇️ Lade Update-Datei herunter...<br>";
echo "Download-URL: $download_url<br>";

if (!is_dir(dirname($update_zip))) mkdir(dirname($update_zip), 0777, true);

$zipData = @file_get_contents($download_url);
if (!$zipData) {
    logUpdate("❌ Fehler beim Herunterladen: $download_url");
    die("❌ Download fehlgeschlagen: Datei nicht gefunden oder Serverfehler.");
}
file_put_contents($update_zip, $zipData);
logUpdate("✅ ZIP erfolgreich heruntergeladen.");

// Backup
echo "📦 Erstelle Backup...<br>";
if (!is_dir($backup_dir)) mkdir($backup_dir, 0777, true);
@copy($base_dir . '/config.php', $backup_dir . '/config.php');
logUpdate("🗂 Backup erstellt: config.php");

// Entpacken
$zip = new ZipArchive();
if ($zip->open($update_zip) === TRUE) {
    echo "📂 Entpacke Update...<br>";
    $zip->extractTo($update_dir);
    $zip->close();
    unlink($update_zip);
    logUpdate("✅ ZIP entpackt und gelöscht.");

    // Automatische Ersetzung bei Web-Umgebung für *_www.php und *_www.js Dateien (rekursiv)
    if ($umgebung === 'web') {
        logUpdate("🌐 Starte automatische Ersetzung rekursiv in der Web-Umgebung...");
        echo "Dies ist die Web-Umgebung<br>";

        function findFilesRecursive($dir, $suffix) {
            $files = [];
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)
            );
            foreach ($iterator as $file) {
                if ($file->isFile() && str_ends_with($file->getFilename(), $suffix)) {
                    $files[] = $file->getPathname();
                }
            }
            return $files;
        }

        function replaceWwwFiles($base_dir, $extension) {
            $suffix = "_www.$extension";
            $files = findFilesRecursive($base_dir, $suffix);

            foreach ($files as $wwwFile) {
                $targetFile = str_replace("_www.$extension", ".$extension", $wwwFile);
                if (@copy($wwwFile, $targetFile)) {
                    echo "🔁 Datei ersetzt: " . basename($targetFile) . " durch " . basename($wwwFile) . "<br>";
                    logUpdate("🔁 Ersetzt: $targetFile durch $wwwFile");
                } else {
                    echo "❌ Fehler beim Ersetzen von $targetFile<br>";
                    logUpdate("❌ Fehler beim Ersetzen von $targetFile");
                }
            }
        }

        replaceWwwFiles($base_dir, 'php');
        replaceWwwFiles($base_dir, 'js');
    }

    echo "📝 Aktualisiere Versionsnummer...<br>";

    // Mapping DB-Update
    $update_sql_map = [
        'portfolio2025' => ['table' => 'portfolio_settings', 'id' => 3],
        'portfolio'     => ['table' => 'portfolio_settings', 'id' => 3],
    ];

    $db_info = $update_sql_map[$expected_dir] ?? null;

    if (!$db_info) {
        logUpdate("❌ Kein SQL-Mapping für Projekt '$expected_dir'");
        die("❌ Kein SQL-Mapping für dieses Projekt gefunden.");
    }

    $table = $db_info['table'];
    $id = $db_info['id'];

    $sql = "UPDATE `$table` SET site_version = ? WHERE id = ?";
    $stmt = $connect->prepare($sql);

    if (!$stmt) {
        echo "❌ Fehler beim SQL-Prepare: " . $connect->error;
        logUpdate("❌ SQL-Fehler beim Prepare: " . $connect->error);
        die();
    }

    $stmt->bind_param("si", $new_version, $id);

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