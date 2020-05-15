<div class="jumbotron jumbotron-fluid p-2">
    <div class="container ">
        <h1 class="display-4">Mustache, paws and tail</h1>
        <p class="lead">Fluffy purring - the best way to calm nerves</p>
    </div>
</div>

<div class="container">

    <?= $pagination ?>

    <hr>

    <div class='row'>
        <div class='col-lg-9'>
            <?
            if (!empty($cardAnimal)) {
                $out = "<div class='row'>";
                foreach ($cardAnimal as $card) {
                    $out .= "<div class='col-lg-4 col-md-6 my-1'>";
                    $out .= "<div class='card'>";
                    $out .= "<img src='images/images_animals/{$card['pictures']}' class='card-img-top' alt={$card['title']}> ";
                    $out .= "<div class='card-body'>";
                    $out .= "<h5 class='card-title'>{$card['title']}</h5>";
                    $out .= "<p class='card-text'>" . mb_strimwidth($card['summary'], 0, 100, "...") . "</p>";
                    $out .= "<a class='btn btn-primary' href='/main/article-cat?id=" . $card['id'] . "'>Read more...</a>";
                    $out .= '</div>';
                    $out .= '</div>';
                    $out .= '</div>';
                }
                $out .= '</div>';
                echo $out;
            }
            ?>
        </div>

        <div class='col-lg-3'>
            <div class='row'>

                <div class='col-lg-12 col-md-6 col-sm-6 my-1'>
                    <?php require 'template/category.php' ?>
                </div>

                <div class='col-lg-12 col-md-6 col-sm-6 my-1 px-4'>
                    <form method="get" class="bg-secondary p-2 border border-dark rounded row">

                        <?
                        if (isset($_GET['page']) && $_GET['page'] != '') {
                            $out = '<input type="input" name="page" ';
                            $out .= "class='d-none' ";
                            $out .= "value={$_GET['page']} >";
                            echo $out;
                        }
                        ?>

                        <div class="form-check col-6">
                            <input class="form-check-input" id="asc" type="radio" value=""
                                   name="desc" <? if ($desc != 'DESC') echo 'checked'; ?>>
                            <label class="form-check-label font-weight-bold" for="asc"><i
                                        class="fas fa-long-arrow-alt-up"></i> ASC</label>
                        </div>
                        <div class="form-check col-6">
                            <input class="form-check-input" id="id" type="radio" value="id"
                                   name="sort" <? if ($sort == 'id') echo 'checked'; ?>>
                            <label class="form-check-label font-weight-bold" for="id">ID</label>
                        </div>
                        <div class="form-check col-6">
                            <input class="form-check-input" id="desc" type="radio" value="DESC"
                                   name="desc" <? if ($desc == 'DESC') echo 'checked'; ?>>
                            <label class="form-check-label font-weight-bold" for="desc"><i
                                        class="fas fa-long-arrow-alt-down"></i> DESC</label>
                        </div>
                        <div class="form-check col-6">
                            <input class="form-check-input" id="title" type="radio" value="title"
                                   name="sort" <? if ($sort == 'title') echo 'checked'; ?>>
                            <label class="form-check-label font-weight-bold" for="title">TITLE</label>
                        </div>

                        <input class="btn btn-warning font-weight-bold mt-3 border border-dark" type="submit"
                               value="Set sort parameters">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <?php require 'template/tag.php' ?>

    <hr>

    <?= $pagination ?>

</div>