<?php
    $json = file_get_contents("captions.json");
    $captions = json_decode($json);
    $images = glob("photo*.jpg");
    
    $out = array();
    foreach ($images as $img) {
        $mycaption = "";
        foreach ($captions as $caption) {
            if ($caption->image == $img) {
                $mycaption = $caption;
                break;
            }
        }

        $obj = new stdClass();
        $obj->html = <<<EOT
<div class='pic'><img src="pics/{$img}" alt="{$mycaption->caption}"><caption>{$mycaption->caption}</caption></div>
EOT;
        $obj->caption = $mycaption;
        $obj->image = $img;
        $out[] = $obj;
    }
    header("Content-Type: application/json");
    print json_encode($out);
    exit;
?>
