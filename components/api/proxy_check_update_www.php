<?php
header('Content-Type: application/json');

$projekt = $_GET['projekt'] ?? '';
$current_version = $_GET['current_version'] ?? '';

if (!$projekt || !$current_version) {
    echo json_encode([
        'success' => false,
        'error' => 'Fehlende Parameter.'
    ]);
    exit;
}

$url = "https://webdesign.digitaleseele.at/projects/updateserver/components/api/api_updates.php?projekt=" . urlencode($projekt) . "&current_version=" . urlencode($current_version);

$response = @file_get_contents($url);
if ($response === false) {
    echo json_encode([
        'success' => false,
        'error' => 'Verbindung zum Update-Server fehlgeschlagen.'
    ]);
    exit;
}

$data = json_decode($response, true);

// Fehlerhafte Antwort prüfen
if (!is_array($data) || !isset($data['success'])) {
    echo json_encode([
        'success' => false,
        'error' => 'Ungültige Server-Antwort.'
    ]);
    exit;
}

// Fall: Kein Update vorhanden
if ($data['success'] && (empty($data['data']) || !isset($data['data']['version']))) {
    echo json_encode([
        'success' => true,
        'data' => null,
        'message' => 'Kein Update verfügbar.'
    ]);
    exit;
}

// Fall: Update vorhanden
if ($data['success'] && isset($data['data']['version'])) {
    echo json_encode([
        'success' => true,
        'data' => $data['data']
    ]);
    exit;
}

// Allgemeiner Fehler
echo json_encode([
    'success' => false,
    'error' => $data['error'] ?? 'Unbekannter Fehler vom Update-Server.'
]);