<div class="container">
    <h2 class="text-center">New task</h2>

    <?php if (isset($_SESSION['task']['taskText'])) : ?>
        <div class="alert-danger border border-dark rounded"><h3
                    class="text-center"><?= $_SESSION['task']['taskText']; ?></h3>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['task']['form'])) : ?>
        <div class="alert-danger border border-dark rounded"><h3
                    class="text-center"><?= $_SESSION['task']['form']; ?></h3>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['task']['userName'])) : ?>
        <div class="alert-danger border border-dark rounded"><h3
                    class="text-center"><?= $_SESSION['task']['userName']; ?></h3>
        </div>
    <?php endif;
    unset($_SESSION['task']); ?>
    <?php if (isset($_SESSION['captcha']) && $_SESSION['captcha'] == 'bot') : ?>
        <div class="bg-dark rounded p-2 my-2 text-center">
            <h3
                    class="text-danger">Are you BOT?
            </h3>
            <img src="/images/skull_48.png" alt="skull">
        </div>
    <?php endif;
    unset($_SESSION['captcha']); ?>


    <form action="/todo-list/newTask" method="POST">

        <input type="hidden" name="token" class="token" value="">

        <div class="form-group">
            <label for="editor">Task:</label>
            <textarea class="form-control" id="editor1" name="taskText" rows="3"
                      required><?= $taskText != '' ? $taskText : '' ?></textarea>
        </div>

        <div class="form-group">
            <label for="userName">User name:</label>
            <input type="text" class="form-control" id="userName" name="userName"
                   value="<?= $userName != '' ? $userName : '' ?>"
                   placeholder="David"
                   required>
        </div>

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?= $email != '' ? $email : '' ?>"
                   placeholder="name@example.com"
                   required>
        </div>

        <button type="submit" class="btn btn-primary mb-2">Add TASK</button>

    </form>
</div>


<?php \fw\core\App::$app->captcha->getScriptsHTML('homepage'); ?>
<?php \fw\core\App::$app->ckeditor->getEditorFirst('editor1'); ?>
