<?php
$out = '';
foreach ($articles as $article) {
    $out .= "<div class='col-lg-6'>";
    $out .= '<hr>';
    $out .= "<div class='text-center'><img src='/images/images_animals/{$article['pictures']}' alt='{$article['title']}' class='w-50 rounded'></div>";
    $out .= "<h2>{$article['title']}</h2>";
    $out .= "<p>{$article['summary']}</p>";
    $out .= '<p><a href="/main/article-cat?id=' . $article['id'] . '">Read more...</a></p>';
    $out .= '</div>';
}
echo $out;
