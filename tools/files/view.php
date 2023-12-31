<?php
$in = $_REQUEST;
$basedir = "/home/cdr/domains/cdr2.com/www/crblog";

if (isset($in['d'])) {
    if (is_dir($basedir.$in['d'])) {
        $dir = $basedir . $in['d'];
        $files = glob($basedir . $in['d']. "/*");
    } else if (is_file($basedir.$in['d'])) {
        $x = file_get_contents($basedir.$in['d']);
        header("Content-Type: " . mime_content_type($basedir.$in['d']));
        print $x;
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: "Lexend", "Helvetica Neue", "Helvetica", sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        header {
            height: 0vh;
        }

        main {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            flex-wrap:wrap;
            background: #ccc;
        }

        footer {
            height: 0vh;
        }

        li {
            display: flex;
            flex-direction: row;
            white-space: nowrap;
        }
        a {
            color: #000;
            text-decoration: none;
        }
        .file {
            width: 10rem;
            height: 12rem;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 1px solid #0009;
            margin: 1rem;
            font-size:16px;
            background: #fff;
            padding-top: 4px;
            font-size: 0.8rem;
        }
        .icon {
            width: 150px;
            height: 150px;
            background-size:contain;
            background-repeat: no-repeat;
            background-position: center top;
        }
        .fileinfo {
            white-space: nowrap;
            font-size: 0.8rem;
        }
        #size-slider {
            position:absolute;
            bottom: 0px;
            right: 0px;
            height: 2rem;
            width: 10rem;
            background: #fff;
            border: 1px solid #0009;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<main>
<datalist id="markers">
  <option value="16"></option>
  <option value="32"></option>
  <option value="64"></option>
  <option value="128"></option>
  <option value="256"></option>
  <option value="512"></option>
  </datalist>
<?php
$out = array();

foreach ($files as $file) {
    $item = new stdClass();
    $item->file = $file;

    $icon = "";
    $item->mimetype = $mime = mime_content_type($file);
    $p = preg_split("/\./", $file);
    $item->extention = $ext = array_pop($p);

    $item->filesize = $size = filesize($file);

    if ($size > 1000000) {
        $size = sprintf("%.01f", $size / 1000000);
        $sizeK = "MB";
    } else if ($size > 1000) {
        $size = sprintf("%.01f", $size / 1000);
        $sizeK = "kB";
    }
    $img = "";
    if (preg_match("/image/", $mime)) {
        $icon = preg_replace("|/home/cdr/domains/cdr2.com/www|", '', $file);
        list($width, $height, $type, $attr) = getimagesize("$file");
        $img = "Dimensions: {$width}x{$height}";
    } else if (is_dir($file)) {
        $icon = "icons/Adwaita/512x512/mimetypes/inode-directory.png";
    } else if (file_exists("free-file-icons/512px/".$ext.".png")) {
        $icon = "free-file-icons/512px/".$ext.".png";
    } else {
        $icon = "free-file-icons/512px/_blank.png";
    }
    $item->icon = $icon;
    $show = preg_replace("|{$dir}/|", '', $file);
    $item->name = $show;
    $out[] = $item;
    //print "file: ".$file."<br>mimetype: ".$mime."<br>icon: ".$icon."<br>show: $show<hr>\n";
print <<<EOT
<div class='file'>
<div style="background-image:url('{$icon}');" class='icon'></div>
<a href='view.php?d={$file}' class='fileinfo'>{$show}</a>
<br>File size: {$size}{$sizeK}<br>$img
</div>

EOT;

}
?>
</main>
<div id="size-slider">
    <input type="range" min="8" max="512" id="slider" name="slider" oninput="app.size(this.value)">
</div>
<script>
const $ = str => document.querySelector(str);
const $$ = str => document.querySelectorAll(str);

(function() {
    const app = {
        data: {},
        state: {
            loaded: false
        },
        init: function() {
            app.state.loaded = true;
        },
        fetch: function(url, callback) {
            fetch(url).then(response=>response.json()).then(data=>{
                app.data = data;
                app.state.loaded = true;
                if (callback && typeof(callback) === "function") {
                    callback(data);
                }
            });
        },
        display: function(data, tgt) {
            let out = "<table><thead><tr>";
            const keys = Object.keys(data[0]);
            if (keys) {
                keys.forEach(key => {
                    out += `<th>${key}</th>`;
                });
            }
            out += "</tr></thead><tbody>";
            data.forEach(item=>{
                out += `<tr>`;
                keys.forEach(key => {
                    out += `<td>${item[i]}</td>`;
                });
                out += `</tr>`;
            });
            out += "</tbody></table>";

            if (tgt) {
                tgt.innerHTML = out;
            }
            return out;
        }
    }
    window.app = app;
    app.init();
})();
</script>
</body>

</html>
