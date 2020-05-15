<?php


namespace app\controllers;

use app\models\TodoList;
use fw\core\App;
use fw\core\base\View;
use fw\libs\Pagination;
use fw\libs\ReCaptchaV3;
use RedBeanPHP\R;

class TodoListController extends AppController
{
    public function indexAction()
    {
        $model = new TodoList();
        $table = $model->tableTasks;

        $total = R::count($table);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 3; // записей на странице при пагинации
        $pagination = new Pagination($page, $perPage, $total);
        $start = $pagination->getStart();

        $sort = 'id';
        $desc = 'DESC';
        if (isset($_GET['sort']) && $_GET['sort'] != '') {
            $sort = $_GET['sort'];
        }
        if (isset($_GET['desc'])) {
            $desc = $_GET['desc'];
        }

        $taskData = R::getAll("select * from $table ORDER BY $sort $desc  LIMIT ?,?", [$start, $perPage]);

        $formForTask = null;
        if (isset($_POST['editTask']) && trim($_POST['editTask']) != '' && $_POST['editTask'] != null) {
            $formForTask = $_POST['editTask'];
        }

        $this->set(compact('taskData', 'formForTask', 'pagination', 'sort', 'desc', 'page'));

        View::setMeta("To do list");

        $_POST['editTask'] = null;
    }

    public function confirmAction()
    {
        $model = new TodoList();
        if (isset($_POST['confirm'])) {
            $task = R::load($model->tableTasks, $_POST['confirm']);
            $task['status'] = 1;
            R::store($task);
            redirect();
        }
    }

    public function editTextAction()
    {
        if (isset($_POST['cancel']) && $_POST['cancel'] == 'cancel') {
            redirect();
            die;
        }

        ReCaptchaV3::getCaptchaVerify($_POST['token'], 0.9, '/todo-list');

        if (isset($_POST['textTask']) && isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') {
            $model = new TodoList();
            $task = R::load($model->tableTasks, $_POST['id']);

            $testTask = trim($_POST['textTask']);//if use CKEDITOR -> function h() is present

            if ($task['task'] != $testTask && $testTask != '') {
                $task['task'] = $testTask;
                $task['editadmin'] = 1;
                R::store($task);
            }
        }
        redirect();
        die;
    }

    public function newTaskAction()
    {
        $taskText = '';
        $userName = '';
        $email = '';


        if (isset($_POST) && !empty($_POST)) {
            $taskText = trim($_POST['taskText']); //if use CKEDITOR -> function h() is present
            $userName = h(trim($_POST['userName']));
            $email = $_POST['email'];

            if ($taskText != '') {
                $newTask['task'] = $taskText;
            } else {
                $_SESSION['task']['taskText'] = 'Text of the task is empty';
            }
            if ($userName != '') {
                $newTask['username'] = $userName;
            } else {
                $_SESSION['task']['userName'] = 'Field of user name is empty';
            }

            if ($taskText != '' && $userName != '') {
                App::$app->captcha->getCaptchaVerify($_POST['token'], 0.9, '/todo-list/newTask');
                $model = new TodoList();
                $table = $model->tableTasks;
                $newTask = R::dispense($table);
                $newTask['task'] = $taskText;
                $newTask['username'] = $userName;
                $newTask['email'] = $email;

                R::store($newTask);

                redirect('/todo-list');
                die;
            }
        }


        $this->set(compact('taskText', 'userName', 'email'));
        View::setMeta("Add new task");
    }
}