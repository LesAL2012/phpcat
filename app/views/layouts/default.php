<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php \fw\core\base\View::getMeta() ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="/css/style.css">

    <link rel="icon" href="/images/favicon.ico" id="favicon">

    <!-- icon font -->
    <script src="/js/all.js" defer></script>
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed&display=swap" rel="stylesheet">
</head>

<body>

<div class="wrapper">
    <?php require_once('template/header.php') ?>

    <?php require_once('template/nav.php') ?>


    <div class="content">
        <div class="container mt-2">
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error'];
                    unset($_SESSION['error']) ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success'];
                    unset($_SESSION['success']) ?>
                </div>
            <?php endif; ?>
        </div>

        <?= $content ?>
    </div>

    <?php require_once('template/footer.php') ;?>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<?php
foreach ($scripts as $item) {
    echo $item;
}
?>

<?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'user') : ?>
    <script>
        document.querySelector("#favicon").href = "/images/faviconCat.ico";
    </script>
<?php elseif (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin') : ?>
    <script>
        document.querySelector("#favicon").href = "/images/faviconAdmin.ico";
    </script>
<?php endif; ?>

</body>

</html>