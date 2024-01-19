<?php
$in = $_REQUEST;
$basedir = "/home/cdr/domains/cdr2.com/www/crblog";

if (isset($in['d'])) {
    if (is_dir($basedir.$in['d'])) {
        $dir = $basedir . $in['d'];
        $files = glob($basedir . $in['d']. "/*");
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
    <title>CR Files: <?php print $in['d']; ?></title>
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
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<main>
    <div class="column"> </div>
    <div class="column"> </div>
    <div class="column"> </div>
    <div class="column"> </div>
</main>
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
