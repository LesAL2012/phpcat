<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 ">
            <h3>Full list</h3>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 ">

            <form method="get" class="bg-secondary p-2 border border-dark rounded mb-2 row formCatList">

                <?
                if (isset($_GET['page']) && $_GET['page'] != '') {
                    $out = '<input type="hidden" name="page" ';
                    $out .= "value={$_GET['page']} >";
                    echo $out;
                }
                ?>

                <div class="form-check col-5">
                    <input class="form-check-input" id="asc" type="radio" value=""
                           name="desc" <? if ($desc != 'DESC') echo 'checked'; ?>>
                    <label class="form-check-label font-weight-bold" for="asc"><i
                                class="fas fa-long-arrow-alt-up"></i> ASC</label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" id="id" type="radio" value="id"
                           name="sort" <? if ($sort == 'id') echo 'checked'; ?>>
                    <label class="form-check-label font-weight-bold" for="id">ID</label>
                </div>
                <div class="form-check col-3">
                    <input class="form-check-input" id="title" type="radio" value="title"
                           name="sort" <? if ($sort == 'title') echo 'checked'; ?>>
                    <label class="form-check-label font-weight-bold" for="title">TITLE</label>
                </div>
                <div class="form-check col-5">
                    <input class="form-check-input" id="desc" type="radio" value="DESC"
                           name="desc" <? if ($desc == 'DESC') echo 'checked'; ?>>
                    <label class="form-check-label font-weight-bold" for="desc"><i
                                class="fas fa-long-arrow-alt-down"></i> DESC</label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" id="category" type="radio" value="category"
                           name="sort" <? if ($sort == 'category') echo 'checked'; ?>>
                    <label class="form-check-label font-weight-bold" for="category">CATEGORY</label>
                </div>

                <div class="col-3 text-right">
                    <input class="btn btn-sm btn-warning font-weight-bold border border-dark" type="submit"
                           value="Set sort">
                </div>

            </form>

        </div>
    </div>


    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-5 ">

            <label for="perPageCat">Records per page:</label>
            <select id="perPageCat">
                <?php
                if (!isset($_SESSION['perPageCat'])) {
                    $_SESSION['perPageCat'] = 10;
                }
                $arrPageCat = [3, 5, 10, 20];
                foreach ($arrPageCat as $item) {
                    if ($item == $_SESSION['perPageCat']) {
                        echo "<option value={$item} selected>{$item}</option>";
                    } else {
                        echo "<option value={$item}>{$item}</option>";
                    }
                }
                ?>
            </select>


        </div>
        <div class="col-lg-6 col-md-6 col-sm-5 ">
            <?= $pagination ?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 text-right">
            <a href="cats/add-article">
                <button class="btn btn-success border border-dark">Add/Edit</button>
            </a>
        </div>
    </div>

    <table class="table table-striped tableCatList">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Summary</th>
            <th>Picture</th>
            <th>Category</th>
            <th>Tags</th>
            <th class="text-center"><img src="/images/edit_icon.png" alt="edit" class="w-24"></th>
<!--            --><?php //if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') : ?>
                <th class="text-center"><img src="/images/delete_icon.png" alt="delete" class="w-24"></th>
<!--            --><?php //endif; ?>

        </tr>

        <?php
        $out = '';
        foreach ($fullInfo as $data) {
            $out .= "<tr>";

            $id = $data['id'];

            $out .= "<td>{$id}</td>";
            $out .= '<td><a href="/main/article-cat?id=' . $id . '">' . $data['title'] . '</a></td>';

            $summary = mb_strimwidth($data['summary'], 0, 60, "...");

            $out .= "<td>{$summary}</td>";
            $out .= "<td><img src='images/images_animals/{$data['pictures']}' alt={$data['title']} style='width:60px'></td>";
            $category = $data['category'];
            $categoryId = $data['categoryid'];
            $out .= '<td><a href="/main/category-selection?cat=' . $categoryId . '">' . $category . '</a></td>';

            $out .= "<td style='font-size: 10px;'>";
            foreach ($data['tag'] as $item) {
                $out .= '<a href="/main/tag-selection?tag=' . $item . '">' . $item . '</a><br>';
            }
            $out .= "</td>";

            $out .= '<td class="text-center align-middle dangerEd" data-id=' . $id . '>
                    <img src="/images/edit_main_icon.png" alt="edit" class="w-32">
                </td>';
//            if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') {
                $out .= '<td class="text-center align-middle dangerDel" data-id=' . $id . '>
                    <img src="/images/delete_main_icon.png" alt="edit" class="w-16">
                </td>';
//            }


            $out .= "</tr>";
        }
        $out .= '</table>';

        echo $out;
        ?>
        <?= $pagination ?>

</div>

<script src="/js/cats.js"></script>
