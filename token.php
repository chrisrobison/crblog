<?php
$now = base64_encode(date("Ymdh"));
$out = new stdClass();
$out->token = $now;

header("Content-Type: application/json");
print json_encode($out);

?>
