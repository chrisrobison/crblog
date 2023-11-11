#!/usr/local/bin/php
<?php
$posts = json_decode(file_get_contents("posts.json"));

$tpl = <<<EOT
    <div class="content-footer">
      <hr><a href="%%next_link%%" onclick="if (parent.app.loadTab) return parent.app.loadTab('%%next_link%%', '%%next_title%%', '%%next_name%%', true, event)" class="next-entry latest" style="font-weight:400;float:right;">(%%next_title%%) Next &gt; </a>
      <a href="%%prev_link%%" onclick="if (parent.app.loadTab) return parent.app.loadTab('%%prev_link%%', '%%prev_title%%', '%%prev_name%%', true, event)" title="%%prev_fulltitle%%" style="font-weight:400;">&lt; Previous (%%prev_title%%)</a>
  </div>
EOT;

for ($idx=1; $idx<count($posts); $idx++) {
    $post = $posts[$idx];
    $next = $posts[$idx - 1];
    $prev = $posts[$idx + 1];
    $out = preg_replace_callback("/\%\%(.+?)\%\%/", function($match) {
        global $prev;
        global $next;
        global $post;
        if (preg_match("/prev_(.*)/", $match[1], $m)) {
            return $prev->{$m[1]};
        } else if (preg_match("/next_(.*)/", $match[1], $m)) {
            return $next->{$m[1]};
        }
    }, $tpl);
    
    replace($post->link, $out);
}

function replace($file, $new) {
    $html = file_get_contents("/home/cdr".$file);
    $lines = preg_split("/\n/", $html);

    $out = "";

    for ($i=0; $i<count($lines); $i++) {
        $line = $lines[$i];

        if (preg_match("/content-footer/", $line)) {
            $out .= $new . "\n";
            $i = $i + 3;
        } else {
            $out .= $line."\n";
        }
    }
    file_put_contents("/home/cdr".$file, $out);
    print "Wrote ".strlen($out)." bytes to new file /home/cdr{$file}\n";
}
?>
