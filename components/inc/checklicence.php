<?php
// Projektinfo definieren
$projektinfo = 'Portfolio 2025'; // Dies kann dynamisch oder via URL übergeben werden
$licenceFile = $_SERVER['DOCUMENT_ROOT'] . '/portfolio2025/licences/licence.key';

// Projektinfo global übergeben
$GLOBALS['projektinfo'] = $projektinfo;

// Globale Datei einbinden, die die Lizenzprüfung übernimmt
require_once '/var/www/html/lizenz_checker/components/inc/checklicencesGlobal.php';
?>