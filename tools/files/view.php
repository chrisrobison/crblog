<?php
$in = $_REQUEST;
$basedir = "/home/cdr/domains/cdr2.com/www";
$httppath = "/crblog";
$shortpath = "";

if (!isset($in['d'])) {
    $in['d'] = '/crblog/';
}
if (isset($in['d'])) {
    if (is_dir($basedir.$in['d'])) {
        $dir = $basedir . $in['d'];
        $shortpath = $in['d'];
        $files = glob($dir. "/*");
    } else if (preg_match("/\.php$/", $basedir.$in['d'])) {
        include($basedir.$in['d']);
       exit; 
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
    <link rel="stylesheet" href="/crblog/assets/fontawesome-free-6.4.0-web/css/all.min.css" />
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
            width: 8rem;
            height: 9rem;
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
            position: relative;
        }
        .icon {
            width: 5rem;
            height: 5rem;
            background-size:contain;
            background-repeat: no-repeat;
            background-position: center top;
        }
        .fileinfo {
            white-space: nowrap;
            font-size: 0.8rem;
        }
        #size-slider {
            position:fixed;
            bottom: 0px;
            right: 0px;
            height: 2rem;
            width: 10rem;
            background: #fff;
            border: 1px solid #0009;
        }
        div > span.label {
            display: none;
        }
        .info {
            display: flex;
        }
        .info > div {
        }
.info {
    display: flex;
    justify-content: space-between;
    flex-direction: row;
    width: 80%;
    font-size: 0.6rem;
    font-weight: 200;
}
.metaicons {
    position: absolute;
    bottom: 0.25rem;
    color: #ccc;
    font-size: 0.7rem;
    right: 0.25rem;
transition: all 200ms linear;
opacity: 0;
}
.file:hover .metaicons {
opacity: 1;
}
.metaicons a {
color: #ccc;
}
.metaicons a:hover {
    color: #0066ff;
}
    </style>
    <script src="/crblog/assets/fontawesome-free-6.4.0-web/js/all.min.js"></script>
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
    $item->modified = filemtime($file);

    $icon = "";
    $item->mimetype = $mime = mime_content_type($file);
    $p = preg_split("/\./", $file);
    $item->extention = $ext = array_pop($p);
    $item->perms = getPerms($file);
    $item->filesize = $size = filesize($file);

    if ($size > 1000000) {
        $size = sprintf("%.01f", $size / 1000000);
        $sizeK = "MB";
    } else if ($size > 1000) {
        $size = sprintf("%.01f", $size / 1000);
        $sizeK = "KB";
    } else {
        $sizeK = "bytes";
    }
    $dimensions = "";
    if ((preg_match("/image/", $mime)) && (!preg_match("/\.[psd|svg|bmp]$/", $file))) {
        $icon = preg_replace("|/home/cdr/domains/cdr2.com/www|", '', $file);
        list($width, $height, $type, $attr) = getimagesize("$file");
        $dimensions = "{$width}x{$height}";
    } else if (is_dir($file)) {
        $icon = "icons/Adwaita/512x512/mimetypes/inode-directory.png";
    } else if (file_exists("img/".$ext.".png")) {
        $icon = "img/".$ext.".png";
    } else {
        $icon = "img/_blank.png";
    }
    $item->icon = $icon;
    $show = preg_replace("|{$dir}/?|", '', $file);
    $shortpath = preg_replace("|/home/cdr/domains/cdr2.com/www|", '', $file);
    $item->name = $show;
    $out[] = $item;
    $modified = date("m/d/Y h:i:s a", $item->modified);
    //print "file: ".$file."<br>mimetype: ".$mime."<br>icon: ".$icon."<br>show: $show<hr>\n";
    $dim = "";
    if ($dimensions) {
        $dim = <<<EOT
<a href="#view-dimensions" title="Dimensions: {$dimensions}"><i class="fa-solid fa-ruler-combined"></i></a>
EOT;
    }

print <<<EOT
<div class='file' data-filename='{$file}' data-modified='{$modified}' data-perms='{$item->perms}' data-owner='{$item->owner}' data-group='{$item->group}'>
    <a href='view.php?d={$shortpath}' title='{$show}' class='fileinfo'><div style="background-image:url('{$icon}');" class='icon'></div></a>
    <a href='view.php?d={$shortpath}' title='{$show}' class='fileinfo'>{$show}</a>
    <div class="metaicons">
        <a href="#view-size" title="Filesize: {$size} {$sizeK}"><i class="fa-solid fa-weight-scale"></i></a>
        {$dim}
        <a href="#view-modified" title="Last Modified: $modified"><i class="fa-regular fa-clock"></i></a>
        <a href="#view-perms" title="Permissions: {$item->perms}"><i class="fa-solid fa-user-lock"></i></a>
    </div>
</div>

EOT;

}
?>
</main>
<div id="size-slider">
    <input list="markers" type="range" min="8" max="512" id="slider" name="slider" oninput="app.size(this.value)">
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
        init() {
            app.state.loaded = true;
        },
        fetch(url, callback) {
            fetch(url).then(response=>response.json()).then(data=>{
                app.data = data;
                app.state.loaded = true;
                if (callback && typeof(callback) === "function") {
                    callback(data);
                }
            });
        },
        size(sz) {
            const stylesheet = document.styleSheets[0];

            Object.values(stylesheet.cssRules).forEach((block) => {
              if (block.selectorText === "button") {
                block.styleMap.set("--mainColor", "black");
              }
            });
        },
        display(data, tgt) {
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
        },
        files: <?php print json_encode($out, JSON_UNESCAPED_SLASHES); ?>
    }
    window.app = app;
    app.init();
})();
</script>
</body>

</html>
<?php
function getPerms($file) {
$perms = fileperms($file);
/*
switch ($perms & 0xF000) {
    case 0xC000: // socket
        $info = 's';
        break;
    case 0xA000: // symbolic link
        $info = 'l';
        break;
    case 0x8000: // regular
        $info = 'r';
        break;
    case 0x6000: // block special
        $info = 'b';
        break;
    case 0x4000: // directory
        $info = 'd';
        break;
    case 0x2000: // character special
        $info = 'c';
        break;
    case 0x1000: // FIFO pipe
        $info = 'p';
        break;
    default: // unknown
        $info = 'u';
}
 */
$info = "";
// Owner
$info .= (($perms & 0x0100) ? 'r' : '-');
$info .= (($perms & 0x0080) ? 'w' : '-');
$info .= (($perms & 0x0040) ?
            (($perms & 0x0800) ? 's' : 'x' ) :
            (($perms & 0x0800) ? 'S' : '-'));

// Group
$info .= (($perms & 0x0020) ? 'r' : '-');
$info .= (($perms & 0x0010) ? 'w' : '-');
$info .= (($perms & 0x0008) ?
            (($perms & 0x0400) ? 's' : 'x' ) :
            (($perms & 0x0400) ? 'S' : '-'));

// World
$info .= (($perms & 0x0004) ? 'r' : '-');
$info .= (($perms & 0x0002) ? 'w' : '-');
$info .= (($perms & 0x0001) ?
            (($perms & 0x0200) ? 't' : 'x' ) :
            (($perms & 0x0200) ? 'T' : '-'));

return $info;
}
?>
