<?php
    $json = file_get_contents("captions.json");
    $captions = json_decode($json);

    $files = glob("*.jpg");

    $pick = rand(0, count($files));

    $img = file_get_contents($files[$pick]);
    header("Content-Type: image/jpeg");
    print $img;
    exit;
?>
