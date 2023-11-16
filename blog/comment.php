<?php
session_start();
$in = $_REQUEST;
$out = array();

if (array_key_exists("page", $in)) {

    if (array_key_exists('x', $in) && $in['x']==="save") {
        $json = file_get_contents("php://input");
        if (file_exists("comments/{$in['page']}.json")) {
            $now = date("Ymdhis");
            $exe = `cp comments/{$in['page']}.json comments/.archive/{$in['page']}-$now.json`;
        }
        file_put_contents("comments/{$in['page']}.json", $json);
    }
    
    if (file_exists("comments/{$in['page']}.json")) {
        $out = json_decode(file_get_contents("comments/{$in['page']}.json"));
    }
}
header("Content-Type: application/json");
print json_encode($out);
?>
