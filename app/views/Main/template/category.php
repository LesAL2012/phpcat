<?php

if (!empty($catAnimal)) {
    $out = '<div class="list-group">';
    foreach ($catAnimal as $category) {
        if (isset($_GET['cat']) && $category['id'] == $_GET['cat']) {
            $out .= '<a class="list-group-item list-group-item-action active" href="/main/category-selection?cat=' . $category['id'] . '">' . $category['description'] . '</a>';
        } else {
            $out .= '<a class="list-group-item list-group-item-action" href="/main/category-selection?cat=' . $category['id'] . '">' . $category['description'] . '</a>';
        }
    }
    $out .= '</div>';
    echo $out;
}
