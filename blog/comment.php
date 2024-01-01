<?php
session_start();
$in = $_REQUEST;
$out = array();

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
        $json = file_get_contents("comments/{$in['page']}.json");
        $obj = json_decode($json);
        foreach ($obj as $comment) {
            $keys = get_object_vars($comment);
            foreach ($keys as $key) {
                $comment->{$key} = htmlspecialchars(strip_tags($comment->{$key}));
            }
        }
        $out = $obj;
    } else {
        
    }
}
header("Content-Type: application/json");
print json_encode($out);
?>
