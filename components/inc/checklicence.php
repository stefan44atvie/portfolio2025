<?php

/* ---- Robuste Lizenzprüfung ---- */

$domain         = $_SERVER['HTTP_HOST'] ?? gethostname(); // Fallback für CLI
$clientIp       = $_SERVER['SERVER_ADDR'] ?? getHostByName(gethostname());
$licenceFile    = '/var/www/html/portfolio2025/licences/licence.key'; // Absoluter Pfad zu Lizenzdatei
$lastCheckFile  = '/var/www/html/portfolio2025/licences/last_check.txt'; // Absoluter Pfad zu Last-Check-Datei
$checkInterval  = 3600;         // 1 Stunde
$gracePeriod    = 86400 * 5;    // 5 Tage

// Debug-Logfunktion (optional)
function logLicenceCheck($message) {
    $logfile = dirname(__DIR__, 2) . '/licences/licence_debug.log';
    @file_put_contents($logfile, "[" . date('c') . "] $message\n", FILE_APPEND);
}

// Lizenzschlüssel laden
if (!file_exists($licenceFile)) {
    logLicenceCheck("❌ Lizenzdatei nicht gefunden unter $licenceFile");
    die('❌ Lizenzdatei nicht gefunden.');
}

$key = trim(file_get_contents($licenceFile));
if ($key === '') {
    logLicenceCheck("❌ Lizenzschlüssel ist leer.");
    die('❌ Lizenzschlüssel ist leer.');
}

// Parameter validieren
if (empty($domain) || empty($key)) {
    logLicenceCheck("❌ Fehlende Parameter. Domain: [$domain], Key: [$key]");
    die("❌ Fehlende Parameter für Lizenzprüfung.");
}

// Aktuelle Zeit
$now = time();

// Prüfen, ob das Prüfungsintervall überschritten wurde
if (file_exists($lastCheckFile)) {
    $lastCheck = filemtime($lastCheckFile);
    if (($now - $lastCheck) < $checkInterval) {
        return; // Noch innerhalb des Prüfintervalls
    }
}

// Lizenzserver kontaktieren

$url = "http://192.168.11.187/lizenz_checker/lizenz_check.php?" . http_build_query([
    
    'domain'      => $domain,
    'key'         => $key,
    'projektinfo' => 'Portfolio Page 2025',
]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$response = curl_exec($ch);
$curlError = curl_error($ch);
curl_close($ch);

// Antwort prüfen
if ($response === false) {
    logLicenceCheck("❌ CURL-Fehler bei Anfrage an $url: $curlError");

    if (!file_exists($lastCheckFile) || ($now - filemtime($lastCheckFile)) > $gracePeriod) {
        die("❌ Lizenzprüfung fehlgeschlagen. Keine Verbindung zum Server.");
    } else {
        logLicenceCheck("✅ Toleranzzeit überschritten, Lizenzprüfung übersprungen.");
        return;
    }
}
echo "Raw Antwort vom Lizenzserver: $response";
// Antwort dekodieren
$data = json_decode($response, true);

// Ausgabe der Antwort vor der Dekodierung
if ($response === false) {
    logLicenceCheck("❌ Fehler beim Abrufen der Antwort von Lizenzserver: $curlError");
} else {
    logLicenceCheck("Antwort vom Lizenzserver: $response");
}

if (!$data) {
    logLicenceCheck("❌ Fehler beim Dekodieren der Antwort. Fehlercode: " . json_last_error());
    die("❌ Fehler beim Dekodieren der Antwort. Raw Antwort: $response");
}

// ✅ Lizenz gültig
@file_put_contents($lastCheckFile, date('c'));
logLicenceCheck("✅ Lizenz gültig für $domain");

/* ---- Ende der Lizenzprüfung ---- */
?>