<div class='container'>
    <div class='row'>
        <div class='col-lg-12'>

            <?php
            $out = '';
            $out .= "<h1 class='text-center'>{$article['title']}</h1>";
            $out .= "<img src='/images/images_animals/{$article['pictures']}' class='rounded mx-auto d-block w-50' alt={$article['title']}>";
            $out .= "<div><p>{$article['summary']}</p>";
            $out .= "<p>{$article['article']}</p></div>";

            echo $out;
            ?>

        </div>
        <div class="col-lg-12 text-center mb-3">

            <?php
            foreach ($tag as $tagArticle) {
                echo "<a class='badge badge-info p-2 m-1' href='/main/tag-selection?tag={$tagArticle['tag']}' class='tag'>{$tagArticle['tag']}</a>";
            }
            ?>

        </div>
    </div>
</div>
