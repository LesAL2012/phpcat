<?php


namespace app\controllers;

use app\models\DragAndDrop;
use fw\core\base\View;
use RedBeanPHP\R;

class DragAndDropController extends AppController
{
    public function indexAction()
    {
        View::setMeta("Drag-and-drop");
    }

    public function getAllTasksAction()
    {
        if ($this->isAjax() && isset($_POST['action']) && $_POST['action'] == 'getAllTasks') {
            $model = new DragAndDrop();
            $tasks = $model->tableTasks;

            echo json_encode(R::getAll("select id, task, username from $tasks"));

            die;

        } else {
            redirect('/');
        }
    }
}
