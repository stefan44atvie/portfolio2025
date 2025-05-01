<?php

/* ---- Robuste Lizenzprüfung ---- */

$domain       = $_SERVER['HTTP_HOST'] ?? gethostname(); 
$clientIp     = $_SERVER['SERVER_ADDR'] ?? getHostByName(gethostname());

// Lokaler Pfad zur Lizenzdatei (eine Ebene über /components/scripts/)
$basePath      = dirname(__DIR__, 2); // geht von /portfolio/components/scripts auf /portfolio
$licenceFile   = $basePath . '/licences/licence.key';
$lastCheckFile = $basePath . '/licences/last_check.txt';

$checkInterval = 3600;         // 1 Stunde
$gracePeriod   = 86400 * 5;    // 5 Tage

// Logfunktion
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

$now = time();

// Prüfintervall
if (file_exists($lastCheckFile)) {
    $lastCheck = filemtime($lastCheckFile);
    if (($now - $lastCheck) < $checkInterval) {
        return; // Noch innerhalb des Intervalls
    }
}

// Lizenzserver anfragen
$url = "https://webdesign.digitaleseele.at/projects/lizenzserver/lizenz_check.php?" . http_build_query([
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
        return;
    }
}

echo "Raw Antwort vom Server:\n";
var_dump($response);

// Antwort auswerten
$data = json_decode($response, true);
if (!$data || !isset($data['status']) || strtolower($data['status']) !== 'aktiv') {
    $fehlermeldung = htmlspecialchars($data['message'] ?? 'Unbekannter Fehler');
    $fehlercode    = htmlspecialchars($data['code'] ?? 'unbekannt');

    logLicenceCheck("❌ Lizenz abgelehnt. Fehler: $fehlermeldung (Code: $fehlercode)");
    die("❌ Lizenzprüfung fehlgeschlagen: $fehlermeldung (Code: $fehlercode)");
}

// ✅ Lizenz gültig
@file_put_contents($lastCheckFile, date('c'));
logLicenceCheck("✅ Lizenz gültig für $domain");

?>