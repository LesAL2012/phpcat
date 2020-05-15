<?php


namespace app\controllers;

use app\models\Cats;
use fw\core\App;
use fw\core\base\View;
use fw\libs\Pagination;
use RedBeanPHP\R;

class CatsController extends AppController
{
    public function indexAction()
    {
        $model = new Cats();
        $table = $model->tableInfoAnimals;
        $category = $model->tableCatAnimals;
        $tag = $model->tableTagAnimal;

        $total = R::count($table);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = isset($_SESSION['perPageCat']) ? (int)$_SESSION['perPageCat'] : 10; // записей на странице при пагинации
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

        $catsList = R::getAll("SELECT $table.*, $category.category
                FROM $table
                LEFT JOIN $category
                ON $category.id = $table.categoryid                
                ORDER BY $sort $desc  LIMIT ?,?", [$start, $perPage]);

        $tags = [];
        foreach ($catsList as $item) {
            $tags[] = $item['id'];
        }

        $catsTag = R::findLike($tag, ['publicid' => $tags], 'ORDER BY tag');

        $fullInfo = [];
        foreach ($catsList as $item) {
            foreach ($catsTag as $tags) {
                if ($item['id'] == $tags['publicid']) {
                    $item['tag'][] = $tags['tag'];
                }
            }
            $fullInfo[] = $item;
        }

        View::setMeta("Cats list");

        $this->set(compact('fullInfo', 'pagination', 'sort', 'desc'));
    }

    public function perPageAction()
    {
        $_SESSION['perPageCat'] = $_POST['numberPages'];
        echo json_encode($_POST['numberPages']);
        die;
    }

    public function addArticleAction()
    {
        View::setMeta("Edit Cats data");
    }

    public function addPostCatAction()
    {
        $model = new Cats();
        $table = $model->tableInfoAnimals;
        $category = $model->tableCatAnimals;
        $tag = $model->tableTagAnimal;

        if ($_POST['action'] == 'addPost') {
            $newRowTableCats = R::dispense($table);

            $newRowTableCats['title'] = $_POST['title'];
            $newRowTableCats['summary'] = $_POST['summary'];
            $newRowTableCats['article'] = $_POST['article'];
            $newRowTableCats['categoryid'] = $_POST['cat'];

            if (file_exists('images/images_animals/' . $_FILES['image']['name'])) {
                $fileName = 'images/images_animals/' . date("dHis") . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                $newRowTableCats['pictures'] = date("dHis") . $_FILES['image']['name'];
            } else {
                $fileName = 'images/images_animals/' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                $newRowTableCats['pictures'] = $_FILES['image']['name'];
            }
            R::store($newRowTableCats);

            $lastId = R::getCell("SELECT id FROM $table ORDER BY id DESC LIMIT 1 ");
            $arrTags = explode(",", trim($_POST['tag'], ','));
            foreach ($arrTags as $item) {
                if ($item != ',' && trim($item) != '') {
                    $newRowTableTags = R::dispense($tag);
                    $newRowTableTags['tag'] = trim($item);
                    $newRowTableTags['publicid'] = $lastId;
                    R::store($newRowTableTags);
                }
            }
        }

        $entries = '5';
        if ($_POST['action'] == 'getThreeEntries') {
            $entries = '3';
        }

        if ($_POST['action'] == 'editPost') {
            $id = $_POST['id'];

            $newRowTableCats = R::load($table, $id);
            $newRowTableCats['title'] = $_POST['title'];
            $newRowTableCats['summary'] = $_POST['summary'];
            $newRowTableCats['article'] = $_POST['article'];
            $newRowTableCats['categoryid'] = $_POST['cat'];

            if (isset($_FILES['image']) && !empty($_FILES['image'])) {
                if (file_exists('images/images_animals/' . $_FILES['image']['name'])) {
                    $fileName = 'images/images_animals/' . date("dHis") . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                    $newRowTableCats['pictures'] = date("dHis") . $_FILES['image']['name'];
                } else {
                    $fileName = 'images/images_animals/' . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
                    $newRowTableCats['pictures'] = $_FILES['image']['name'];
                }
            }

            R::store($newRowTableCats);

            $remRowTag = R::findLike($tag, ['publicid' => $id]);
            R::trashAll($remRowTag);

            $lastId = $id;
            $arrTags = explode(",", trim($_POST['tag'], ','));
            foreach ($arrTags as $item) {
                if ($item != ',' && trim($item) != '') {
                    $newRowTableTags = R::dispense($tag);
                    $newRowTableTags['tag'] = trim($item);
                    $newRowTableTags['publicid'] = $lastId;
                    R::store($newRowTableTags);
                }
            }
        }

        if ($_POST['action'] == 'getArticleById' || $_POST['action'] == 'editPost') {
            $catsList = R::getAll("SELECT $table.*, $category.category
                FROM $table
                LEFT JOIN $category
                ON $category.id = $table.categoryid
                where $table.id like ? LIMIT ?", [$_POST['id'], 1]);
        } else {
            $catsList = R::getAll("SELECT $table.*, $category.category
                FROM $table
                LEFT JOIN $category
                ON $category.id = $table.categoryid
                ORDER BY id DESC  LIMIT ?", [$entries]);
        }

        $tags = [];
        foreach ($catsList as $item) {
            $tags[] = $item['id'];
        }

        $catsTag = R::findLike($tag, ['publicid' => $tags], 'ORDER BY tag');

        $fullInfo = [];
        foreach ($catsList as $item) {
            foreach ($catsTag as $tags) {
                if ($item['id'] == $tags['publicid']) {
                    $item['tag'][] = $tags['tag'];
                }
            }
            $fullInfo[] = $item;
        }

        echo json_encode($fullInfo);
        die;
    }

    // use Registry
    public function addCategoryAction()
    {
        if ($this->isAjax()) {
            $model = new Cats();
            $category = $model->tableCatAnimals;
            App::$app->cache->delete($category);

            if ($_POST['action'] == 'addCategory') {
                $newRow = R::dispense($category);
                $newRow['category'] = $_POST['category'];
                $newRow['description'] = $_POST['description'];
                R::store($newRow);
            } elseif ($_POST['action'] == 'editCategory') {
                $id = $_POST['id'];
                $editRow = R::load($category, $id);
                $editRow['category'] = $_POST['category'];
                $editRow['description'] = $_POST['description'];
                R::store($editRow);
            }

            $dataCategory = R::getAll("select id,category,description from $category ORDER BY id DESC");
            echo json_encode($dataCategory);

            die;
        } else {
            redirect('/cats');
        }
    }

    // use Registry
    public function removeCategoryAction()
    {
        if ($this->isAjax() && $_POST['action'] == 'removeCategory') {
            $model = new Cats();
            $category = $model->tableCatAnimals;
            App::$app->cache->delete($category);

            $id = $_POST['id'];
            $removeRow = R::load($category, $id);
            R::trash($removeRow);

            $dataCategory = R::getAll("select id,category,description from $category ORDER BY id DESC");

            echo json_encode($dataCategory);

            die;
        } else {
            redirect('/cats');
        }
    }

    // use Registry
    public function editCategoryAction()
    {
        if ($this->isAjax()) {
            $model = new Cats();
            $category = $model->tableCatAnimals;
            App::$app->cache->delete($category);

            if ($_POST['action'] == 'getEditCategory') {
                $id = $_POST['id'];
                $oneRow = R::getRow("select * from $category where id like ? limit 1", [$id]);

                echo json_encode($oneRow);
            } elseif ($_POST['action'] == 'getAllCategory') {
                $dataCategory = R::getAll("select id,category,description from $category ORDER BY id DESC");
                echo json_encode($dataCategory);
            }

            die;
        } else {
            redirect('/cats');
        }
    }

    public function deleteCatsAction()
    {
        if ($_POST['action'] == 'deleteCats') {
            $model = new Cats();
            $table = $model->tableInfoAnimals;
            $tag = $model->tableTagAnimal;

            $id = $_POST['id'];
            $removeRowTable = R::load($table, $id);
            R::trash($removeRowTable);

            //check - remove pictures from directory
            $filesArr = [];
            $filesFromTable = R::getCol("select pictures from $table ");
            foreach ($filesFromTable as $item) {
                $filesArr['table'][] = $item;
            }
            $filesFromDir = scandir('images/images_animals/');
            foreach ($filesFromDir as $item) {
                if ($item != '.' && $item != '..') {
                    $filesArr['dir'][] = $item;
                }
            }
            foreach ($filesArr['dir'] as $item) {
                if (!in_array($item, $filesArr['table'])) {
                    unlink("images/images_animals/$item");
                }
            }

            //check - remove tags from tableTags
            $tagsIDArr = [];
            $id = R::getCol("select id from $table");
            foreach ($id as $item) {
                $tagsIDArr['tableID'][] = $item;
            }
            $publicID = R::getCol("select DISTINCT publicid from $tag");
            foreach ($publicID as $item) {
                if ($item != '.' && $item != '..') {
                    $tagsIDArr['tagID'][] = $item;
                }
            }
            if (!empty($tagsIDArr['tableID']) && count($tagsIDArr['tableID']) > 2) {
                foreach ($tagsIDArr['tagID'] as $item) {
                    if (!in_array($item, $tagsIDArr['tableID'])) {
                        $tagsIDArr['remove'][] = $item;
                    }
                }
            }
            $remRowTag = R::findLike($tag, ['publicid' => $tagsIDArr['remove']]);
            R::trashAll($remRowTag);

            die;
        } else {
            redirect('/cats');
        }
    }
}
