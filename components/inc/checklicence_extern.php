<?php

/* ---- Robuste Lizenzprüfung ---- */

$domain         = $_SERVER['HTTP_HOST'] ?? gethostname(); // Fallback für CLI
$clientIp       = $_SERVER['SERVER_ADDR'] ?? getHostByName(gethostname());
$licenceFile    = dirname(__DIR__, 1) . '/licences/licence.key';
$lastCheckFile  = dirname(__DIR__, 1) . '/licences/last_check.txt';
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
$url = "https://webdesign.digitaleseele.at/projects/lizenzserver/lizenz_check.php?" . http_build_query([
    'domain'      => $domain,
    'key'         => $key,
    'projektinfo' => 'Portfolio 2025 extern',
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

    // Toleranzzeit prüfen
    if (!file_exists($lastCheckFile) || ($now - filemtime($lastCheckFile)) > $gracePeriod) {
        die("❌ Lizenzprüfung fehlgeschlagen. Keine Verbindung zum Server.");
    } else {
        return; // Innerhalb der Toleranz
    }
}

// Antwort dekodieren
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

/* ---- Ende der Lizenzprüfung ---- */
?>