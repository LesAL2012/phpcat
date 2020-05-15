<div class='container mb-3'>
    <div class="text-center display-4 mb-3">
        <h1>Selection by categories</h1>
        <b><?= strtoupper($catData['category']) ?>:</b> <?= strtolower($catData['description']) ?>
    </div>

    <div class='row'>
        <div class='col-lg-9'>
            <div class='row'>
                <?php require 'template/articles.php' ?>
            </div>
        </div>
        <div class='col-lg-3'>
            <hr>
            <?php require 'template/category.php' ?>
        </div>

    </div>

    <hr>

    <?php require 'template/tag.php' ?>

</div>

