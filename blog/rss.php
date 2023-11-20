<?php

$posts = json_decode(file_get_contents("posts.json"));

/*
<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">

<channel>
  <title>W3Schools Home Page</title>
  <link>https://www.w3schools.com</link>
  <description>Free web building tutorials</description>
  <item>
    <title>RSS Tutorial</title>
    <link>https://www.w3schools.com/xml/xml_rss.asp</link>
    <description>New RSS tutorial on W3Schools</description>
  </item>
  <item>
    <title>XML Tutorial</title>
    <link>https://www.w3schools.com/xml</link>
    <description>New XML tutorial on W3Schools</description>
  </item>
</channel>

</rss>
 */
$out = '<?xml version="1.0" encoding="UTF-8" ?><rss version="2.0"><channel><title>Christopher Robison\'s Incredible Blog</title><category>Programming</category><link>https://cdr2.com</link><description>Getting the job done from Apache to z-index.</description><image><url>https://cdr2.com/crblog/assets/img/robot-reading.jpg</url><title>Christopher Robison\'s Incredible Blog</title><link>https://cdr2.com</link></image>';

$cnt = 0;
foreach ($posts as $post) {
    ++$cnt;
    $post->blurb = preg_replace("/<[^>]+>/", "", $post->blurb);
    $date = date("r", strtotime($post->date));
    $out .= "<item><title>{$post->fulltitle}</title><link>https://cdr2.com{$post->link}</link><description><![CDATA[<img src=\"https://cdr2.com{$post->hero}\" align=\"left\" hspace=\"5\">{$post->blurb}]]></description><guid isPermaLink=\"true\">https://cdr2.com{$post->link}</guid><pubDate>{$date}</pubDate></item>";

    if ($cnt > 10) {
       break;
    }
}
$out .= "</channel></rss>";

header("Content-Type: application/rss+xml");
print $out;

?>
