<?php
if (empty($_GET['hmac']) || empty($_GET['host'])) {
  header('HTTP/1.0 400 Bad Request');
  exit;
}
$secret = getenv("SECRET"); 
if (isset($_GET['nonce'])) {
  $secret = hash_hmac('sha256', $_GET['nonce'], $secret);
}
$hmac = hash_hmac('sha256', $_GET['host'], $secret);
if ($hmac !== $_GET['hmac']) {
  header('HTTP/1.0 403 Forbidden');
  exit;
}
echo getenv("FLAG");
?>
