<div class='container mb-3'>
    <div class="text-center display-4 mb-3">
        Tag selection: <b><?= strtoupper($_GET['tag']) ?></b>
    </div>

    <hr>

    <?php require 'template/tag.php' ?>

    <div class='row'>
        <?php require 'template/articles.php' ?>
    </div>

    <hr>

    <?php require 'template/tag.php' ?>

</div>
