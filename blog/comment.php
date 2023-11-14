<?php
session_start();
$in = $_REQUEST;

if (array_key_exists("page", $in)) {
    if (array_key_exists("data", $in)) {
        file_put_contents("comments/{$in['page']}.json", $in['data']);
    }
    
    if (file_exists("comments/{$in['page']}.json")) {
        $obj = json_decode(file_get_contents("comments/{$in['page']}.json"));
        header("Content-Type: application/json");
        print json_encode($obj);
    }
}
?>
