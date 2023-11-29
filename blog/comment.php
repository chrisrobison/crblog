<?php
session_start();
$in = $_REQUEST;
$out = array();
$ref = $_SERVER['HTTP_REFERER'];
$host = $_SERVER['HTTP_HOST'];

if (preg_match("/^http[s]?:\/\/([^\/]*)(\/.*)/", $ref, $matches)) {
    $refHost = $matches[1];
    $refPath = $matches[2];
    if ($refHost != $host) {
        
    }
}
if (array_key_exists("page", $in)) {

    if (array_key_exists('x', $in) && $in['x']==="save") {
        $json = file_get_contents("php://input");
        $json = htmlspecialchars(strip_tags($json),ENT_NOQUOTES);

        if (file_exists("comments/{$in['page']}.json")) {
            $now = date("Ymdhis");
            $exe = `cp comments/{$in['page']}.json comments/.archive/{$in['page']}-$now.json`;
        }
        file_put_contents("comments/{$in['page']}.json", $json);
        chmod("comments/{$in['page']}.json", 0664);
    }
    
    if (file_exists("comments/{$in['page']}.json")) {
        $out = json_decode(htmlspecialchars(strip_tags(file_get_contents("comments/{$in['page']}.json"))));
    }
}
header("Content-Type: application/json");
print json_encode($out);
?>
