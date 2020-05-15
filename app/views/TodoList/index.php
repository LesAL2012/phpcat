<div class="container">

    <?php if (isset($_SESSION['captcha']) && $_SESSION['captcha'] == 'bot') : ?>
        <div class="bg-dark rounded p-2 my-2 text-center">
            <h3
                    class="text-danger">Are you BOT?
            </h3>
            <img src="/images/skull_48.png" alt="skull">
        </div>
    <?php endif;
    unset($_SESSION['captcha']); ?>



    <h3 class="text-center">Pure
        <img src="/public/images/php_logo.png" alt="php" class="w-96">
         - <span class="text-danger">NO</span>
        <img src="/public/images/js_logo.png" alt="js" class="w-48">
        (no
        <img src="/public/images/jQuery_logo.png" alt="jQuery" class="w-128">,
        no
        <img src="/public/images/AJAX_logo.svg" alt="AJAX" class="w-96">)
    </h3>
    <hr>
    <div>
        <h4 class="float-left p-0 m-0">
            Edit tasks and confirm - only <a href="/user/login" target="_blank">admin</a><br>
            All users can add tasks
        </h4>

        <a href="/todo-list/new-task">
            <button class="btn btn-info border border-dark float-right">
                Add new task
                <img src="/public/images/todo_list/addNewTask.png" alt="task" class="w-24">
            </button>
        </a>
        <div class="float-cleaner"></div>
    </div>
    <hr>
    <div class="text-center my-2">
        <span class="font-weight-bold mr-2">Sort by:</span>
        <div class="btn-group" role="group" aria-label="Basic example">
            <form>
                <input type="hidden" name="sort" value="id">
                <input type="hidden" name="desc" value="">
                <input type="hidden" name="page" value=<?= $page ?>>
                <button type="submit"
                        class="rounded-0 btn <?= ($sort == 'id' && $desc == '') ? 'btn-primary' : 'btn-secondary' ?>">
                    id<i class="fas fa-arrow-up"></i>
                </button>
            </form>
            <form>
                <input type="hidden" name="sort" value="id">
                <input type="hidden" name="desc" value="DESC">
                <input type="hidden" name="page" value=<?= $page ?>>
                <button type="submit"
                        class="rounded-0 border-left mr-2 btn <?= ($sort == 'id' && $desc == 'DESC') ? 'btn-primary' : 'btn-secondary' ?>">
                    id<i class="fas fa-arrow-down"></i>
                </button>
            </form>

            <form>
                <input type="hidden" name="sort" value="username">
                <input type="hidden" name="desc" value="">
                <input type="hidden" name="page" value=<?= $page ?>>
                <button type="submit"
                        class="rounded-0 btn <?= ($sort == 'username' && $desc == '') ? 'btn-primary' : 'btn-secondary' ?>">
                    <i class="fas fa-user"></i>
                    <i class="fas fa-arrow-up"></i>
                </button>
            </form>
            <form>
                <input type="hidden" name="sort" value="username">
                <input type="hidden" name="desc" value="DESC">
                <input type="hidden" name="page" value=<?= $page ?>>
                <button type="submit"
                        class="rounded-0 border-left mr-2 btn <?= ($sort == 'username' && $desc == 'DESC') ? 'btn-primary' : 'btn-secondary' ?>">
                    <i class="fas fa-user"></i>
                    <i class="fas fa-arrow-down"></i>
                </button>
            </form>

            <form>
                <input type="hidden" name="sort" value="email">
                <input type="hidden" name="desc" value="">
                <input type="hidden" name="page" value=<?= $page ?>>
                <button type="submit"
                        class="rounded-0 btn <?= ($sort == 'email' && $desc == '') ? 'btn-primary' : 'btn-secondary' ?>">
                    <i class="fas fa-envelope-open-text"></i>
                    <i class="fas fa-arrow-up"></i>
                </button>
            </form>
            <form>
                <input type="hidden" name="sort" value="email">
                <input type="hidden" name="desc" value="DESC">
                <input type="hidden" name="page" value=<?= $page ?>>
                <button type="submit"
                        class="rounded-0 border-left mr-2 btn <?= ($sort == 'email' && $desc == 'DESC') ? 'btn-primary' : 'btn-secondary' ?>">
                    <i class="fas fa-envelope-open-text"></i>
                    <i class="fas fa-arrow-down"></i>
                </button>
            </form>

            <form>
                <input type="hidden" name="sort" value="status">
                <input type="hidden" name="desc" value="DESC">
                <input type="hidden" name="page" value=<?= $page ?>>
                <button type="submit"
                        class="rounded-0 btn <?= ($sort == 'status' && $desc == 'DESC') ? 'btn-primary' : 'btn-secondary' ?>">
                    <i class="fas fa-thumbs-up"></i>
                    <i class="fas fa-arrow-up"></i>
                </button>
            </form>
            <form>
                <input type="hidden" name="sort" value="status">
                <input type="hidden" name="desc" value="">
                <input type="hidden" name="page" value=<?= $page ?>>
                <button type="submit"
                        class="rounded-0 border-left btn <?= ($sort == 'status' && $desc == '') ? 'btn-primary' : 'btn-secondary' ?>">
                    <i class="fas fa-thumbs-down"></i>
                    <i class="fas fa-arrow-down"></i>
                </button>
            </form>
        </div>
    </div>

    <table class="table table-darkLine">
        <thead>
        <tr class="text-center align-middle table-darkHead ">
            <th class="align-middle <?= ($sort == 'id') ? 'text-primary' : '' ?>">ID<br>
                <img class="w-32" src="images/todo_list/id.png" alt="id">
            </th>
            <th class="align-middle">Task
                <div class="d-flex justify-content-around">
                    <img class="w-48" src="/public/images/todo_list/task0.png" alt="task">
                    <img class="w-48" src="/public/images/todo_list/task1.png" alt="task">
                    <img class="w-48" src="/public/images/todo_list/task2.png" alt="task">
                </div>

            </th>
            <th class="align-middle <?= ($sort == 'username') ? 'text-primary' : '' ?>">User Name<br>
                <img class="w-64" src="/public/images/todo_list/user.png" alt="user">
            </th>
            <th class="align-middle <?= ($sort == 'email') ? 'text-primary' : '' ?>">Email<br>
                <img class="w-64" src="/public/images/todo_list/mail.png" alt="mail">
            </th>
            <th class="align-middle <?= ($sort == 'status') ? 'text-primary' : '' ?>">Status<br>
                <img class="w-64" src="/public/images/todo_list/status.png" alt="status">
            </th>
            <th class="align-middle" style="min-width: 90px">Admin<br>
                <img class="w-64" src="/public/images/todo_list/admin.png" alt="admin">
            </th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($taskData as $data) : ?>
            <tr class=<?= $data['status'] ? 'bg-confirmed' : 'bg-notConfirmed'; ?>>
                <th class="text-center align-middle"><?= $data['id']; ?></th>
                <td class="align-middle">

                    <?php if ($formForTask && $formForTask == $data['id']) : ?>
                        <form action="/todo-list/editText" method="POST">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">

                            <input type="hidden" name="token" class="token" value="">

                            <textarea class="form-control" rows="3" name="textTask" id="editor1"><?= $data['task']; ?></textarea>
                            <input type="submit" class="btn btn-sm btn-primary bordered border-dark mt-1 float-left"
                                   value="Edit">
                        </form>

                        <form action="/todo-list/editText" method="POST">
                            <input type="hidden" name="cancel" value="cancel">
                            <input type="submit" class="btn btn-sm btn-warning bordered border-dark mt-1 float-right"
                                   value="Cancel">
                        </form>
                        <?php \fw\core\App::$app->captcha->getScriptsHTML('homepage'); ?>
                        <?php \fw\core\App::$app->ckeditor->getEditorFirst('editor1'); ?>
                    <?php else : ?>
                        <?=  $data['task']; ?>
                    <? endif; ?>

                </td>
                <td class="text-center align-middle"><?= $data['username']; ?></td>
                <td class="text-center align-middle"><?= $data['email']; ?></td>
                <td class="text-center font-weight-bold align-middle"><?= $data['status'] ?
                        '<span class="text-primary">Done</span><br><img class="w-64" src="/public/images/todo_list/done.png" alt="done">' :
                        '<span class="text-danger">Not<br><img class="w-48" src="/public/images/todo_list/notDone.png" alt="not-done"><br>confirmed</span>'; ?>

                    <?= (!$data['status'] && isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') ?'
                    <br>
                    <form action="/todo-list/confirm" method="POST">
                        <input type="hidden" name="confirm" value=' . $data['id'] . '>
                        <input type="submit" class="btn btn-sm btn-success bordered border-dark" value="Confirm">
                    </form>
                    ' : ''?>

                </td>
                <td class="text-center font-weight-bold">

                    <?= (!$data['status'] && isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') ?'
                    <br>
                    <form method="POST">
                        <input type="hidden" name="editTask" value=' . $data['id'] . '>
                        <input type="submit" class="btn btn-sm btn-secondary bordered border-dark"
                               value="Edit task"><br>
                    </form>
                     ' : ''?>

                    <?= $data['editadmin'] ? '<span class="text-danger">Edited by<br><img class="w-64" src="/public/images/todo_list/editedAdmin.png" alt="admin"><br>ADMIN</span>' : ''; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?= $pagination ?>
</div>
