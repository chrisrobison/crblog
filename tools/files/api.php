<?php
$in = $_REQUEST;
$basepath = "/home/cdr/domains/cdr2.com/www/crblog";
$out = new stdClass();
if (!isset($in['f'])) $in['f'] = "";

    if (is_dir($basepath . $in['f'])) {
        $files = glob($basepath.$in['f']."/*");
        $out->files = array();
        for ($i=0; $i<count($files); $i++) {
            $out->files[$i] = new stdClass();
            $out->files[$i]->filename = preg_replace("|$basepath|", '', $files[$i]);
            $isdir = is_dir($files[$i]);
            $files[$i] = escapeshellarg($files[$i]);
            $out->files[$i]->mimetype = `file -b --mime-type {$files[$i]}`;
            $out->files[$i]->mimetype = trim($out->files[$i]->mimetype);
            $ico = preg_replace("/\//", '-', $out->files[$i]->mimetype);
            $out->files[$i]->isdir = false;

            if ($isdir) {
                $out->files[$i]->icon = "/crblog/tools/files/icons/Adwaita/48x48/places/folder.png";
                $out->files[$i]->isdir = true;
            } else if (file_exists("/home/cdr/cdr2/img/mimetypes/$ico.png")) {
                $out->files[$i]->icon = "/img/mimetypes/$ico.png";
            } else if (file_exists("/home/cdr/cdr2/img/mimetypes/".preg_replace("/\-.*/", '', $ico).".png")) {
                $out->files[$i]->icon = "/img/mimetypes/".preg_replace("/\-.*/", '', $ico).".png";
            } else {
                $out->files[$i]->icon = "/img/mimetypes/text.png";
            }
        }
    } else {
        if (file_exists($basepath.$in['f'])) {
            $mimetype = `file -b --mime-type {$basepath}{$in['f']}`;
            if (preg_match("/image/", $mimetype)) {
                $out->content = "<img src='/crblog".$in['f']."'>";
                $out->type = "text/html";
            } else {
                $out->type = $mimetype;
                $out->content = file_get_contents($basepath.$in['f']);
            }
        }
    }
    header("Content-Type: application/javascript");
    print json_encode($out, JSON_UNESCAPED_SLASHES);
?>
