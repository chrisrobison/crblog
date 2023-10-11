<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        * { box-sizing: border-box; }
        img { width: 300px; margin: 1rem; }
        body {
            display: flex;
            justify-content: space-evenly;
            align-items: flex-start;
            flex-wrap: wrap;
            flex-direction: row;
            background: #001;
        }
    </style>
</head>
<body>
<?php
$files = glob("*.jpg");

foreach ($files as $file) {
    print "<span><a href='$file' target='_blank'><img src='$file' width='300'><br>$file</a><input type='text' size='30' id='img-$file' onchange='updateCaption(\"$file\", this.value)'></span>";
}
?>
<br><label for="json">JSON</label> <textarea rows="5" cols="50" id="json" name="json"></textarea>
<script>
let captions = [];
function updateCaption(who, what) {
    let idx = captions.findIndex(item => item.image===who);
    if (idx > -1) {
        captions[idx] = { image: who, caption: what };
    } else {
        captions.push( { image: who, caption: what } );
    }

    document.querySelector("#json").value = JSON.stringify(captions);
}
</script>
</body>
</html>
