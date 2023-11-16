<?php
session_start();
$in = $_REQUEST;
$out = array();

if (array_key_exists("page", $in)) {
    if (array_key_exists("data", $in)) {
        if (file_exists("comments/{$in['page']}.json")) {
            $now = date("Ymdhis");
            $exe = `cp comments/{$in['page']}.json comments/.archive/{$in['page']}-$now.json`;
        }
        file_put_contents("comments/{$in['page']}.json", $in['data']);
    }
    
    if (file_exists("comments/{$in['page']}.json")) {
        $out = json_decode(file_get_contents("comments/{$in['page']}.json"));
    }
}
header("Content-Type: application/json");
print json_encode($out);
?>
