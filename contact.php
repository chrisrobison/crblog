<?php
    $in = $_REQUEST;

    $in['date'] = date("Y-m-d h:i:s");
    $json = file_get_contents("incoming.txt");
    $all = json_decode($json);

    $all[] = $in;

    file_put_contents("incoming.txt", json_encode($all));
    
    print "<h1>Thank you, your message has been received.</h1>";

?>
