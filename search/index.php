<?php
    $in = $_REQUEST;

if (isset($in['q'])) {
    $parts = preg_split("/(AND|OR)/i", $in['q']);

    escapeshellarg(
}
?>
