<?php 

$projekt = 'Portfolio 2025';
$domain = $_SERVER['SERVER_NAME'];
$ip = $_SERVER['SERVER_ADDR'];
$licenceFile = __DIR__ . '/../../licences/licence.key';
$key_hash = file_exists($licenceFile) ? hash_file('sha256', $licenceFile) : '';

$url = 'https://webdesign.digitaleseele.at/projects/lizenzserver/components/api/api_checklicence.php?' . http_build_query([
    'projekt'   => $projekt,
    'domain'    => $domain,
    'ip'        => $ip,
    'key_hash'  => $key_hash
]);

$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data['status'] !== 'ok') {
    die("Lizenzfehler: " . $data['message']);
}

?>