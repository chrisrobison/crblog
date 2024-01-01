<?php
    $in = $_REQUEST;
if (!isset($in['q'])) $in['q'] = "projects";
$blogs = json_decode(file_get_contents("blog/posts.json"));

if (isset($in['q'])) {
    $query = preg_replace("/[^a-zA-Z0-9\-\s]/", '', $in['q']);
    //$query = preg_replace("/\s(the|of|and|or|I|a|is|are|will|would|have|to|shall|should|can|do|did|has|had|be|being|been|does)\s/i", " ", $query);

    $words = preg_split("/\s/", $query);
    for ($i=0;$i<count($words);$i++) {
        $words[$i] = escapeshellarg($words[$i]);
    }
    
    if (count($words)) {
        $qwords = "'" . implode("|", $words). "'";
        $cmd = "egrep -Rci $qwords search/*";
    }
    $exe = `$cmd`;
    $results = preg_split("/\n/", $exe);
    $cnts = array();
    
    $found = array();
    $seen = array();
    foreach ($results as $result) {
        if ($result) {
            $parts = preg_split("/\:/", $result);
            if (count($parts)>0) {
                $file = preg_replace("/^search\//", "", $parts[0]);
                
                $content = file_get_contents("search/$file");

                $count = $parts[1];
                $qwords = implode("|", $words);
                if ($count > 0) {
                    $blurbs = `egrep -i -C 6 $qwords search/$file`;
                    $blurb = preg_split("/\-\-/", $blurbs);
                    $obj = $found[] = new stdClass();
                    $obj->link = $parts[0];
                    $obj->weight = $count;
                    $obj->snippet = preg_replace("/($qwords)/i", '<span class="match">$1</span>', strip_tags($blurb[0]));
                    $obj->url = "/crblog/" . $file;
                    $obj->title = preg_replace("/\-\sChr.*/", '', trim(preg_replace("/<.+?>/", "", `egrep -i '<title' $file`)));
                    $seen[$parts[0]] = count($found) - 1;

                    if (preg_match("/".$qwords."/i", $obj->title)) {
                        $obj->weight += 100;
                    }
                }
            }
        }
    }
    header("Content-Type: application/json");
    print json_encode($found, JSON_UNESCAPED_SLASHES );
}

?>
