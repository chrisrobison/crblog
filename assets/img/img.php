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
        body {
            font-family: "Lexend", "Helvetica Neue", "Helvetica", sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color:#333;
        }

        header {
            background-color: #999;
            color: #eee;
            height: 0vh;
        }

        main {
            color: #ddd;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }
        img {
            margin: 0.5rem;
        }
        footer {
            background-color: #666;
            color: #eee;
            height: 0vh;
        }

        li {
            display: flex;
            flex-direction: row;
            white-space: nowrap;
        }
        figure {
            display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
            height: 33vh;
            width: 18vw;
            background-color: #fff;
            box-shadow: 3px 3px 3px #0006;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<main>
<?php
$files = glob("*");
$images = array();
$out = "";

foreach ($files as $file) {
    if (preg_match("/\.(jpg|png|gif|svg)$/", $file)) {
        list($w, $h, $type, $attr) = getimagesize($file);
        $sz = filesize($file);
        $st = '';
        if ($sz > 1024) {
            $sz = $sz / 1024;
            $st = "KB";
        } 
        if ($sz > 1024) {
            $sz = $sz / 1024;
            $st = "MB";
        }
        if ($sz > 1024) {
            $sz = $sz / 1024;
            $st = "GB";
        }
        $sz = number_format($sz);
        $out .= <<<EOT
<figure>
<img title='$file' src='$file' width='150'>
<caption><a href="$file" target="_blank">$file<br>$sz $st    &nbsp;  [{$w}x{$h}]</a></caption>
</figure>
EOT;
        $images[] = $file;
    }
}
print $out;

?>

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
