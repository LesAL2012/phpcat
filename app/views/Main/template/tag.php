<div class='row'>
    <div class="col-lg-12 text-center">
        <?
        if (!empty($tagAnimal)) {
            foreach ($tagAnimal as $tag) {
                echo "<a class='badge badge-info p-2 m-1' href='/main/tag-selection?tag={$tag['tag']}' class='tag'>{$tag['tag']}</a>";
            }
        }
        ?>
    </div>
</div>
