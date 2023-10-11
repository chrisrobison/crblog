<?php
    $json = file_get_contents("captions.json");
    $captions = json_decode($json);

    if (array_key_exists("img", $_REQUEST)) {
        if (!preg_match("/\.(jpg|png|gif|webm)/", $_REQUEST['img'])) {
            $img = sprintf("photo_%03d.jpg", $_REQUEST['img']);
        } else {
            $img = $_REQUEST['img'];
        }
        $mycaption = "";
        foreach ($captions as $caption) {
            if ($caption->image == $img) {
                $mycaption = $caption;
                break;
            }
        }

        $out = new stdClass();
        $out->html = <<<EOT
<div class='pic'><img src="/new/pics/{$img}" alt="{$mycaption->caption}"><caption>{$mycaption->caption}</caption></div>
EOT;
        $out->caption = $mycaption;
        $out->image = $img;

        header("Content-Type: application/json");
        print json_encode($out);
        exit;
    }
?>
