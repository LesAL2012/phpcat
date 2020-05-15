<?php

namespace fw\core\base;

use fw\core\Db;
use Valitron\Validator;
use \RedBeanPHP\R;

abstract class Model extends \RedBeanPHP\SimpleModel
{
    protected $pdo;
    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct()
    {
        $this->pdo = Db::instance();
    }

    public function load($data)
    {
        foreach ($this->attributes as $name => $value) {
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function validate($data)
    {
        $v = new Validator($data);
        $v->rules($this->rules);
        if ($v->validate()) {
            return true;
        } else {
            $this->errors = $v->errors();
            return false;
        }
    }

    //сохранеие юзера при регистрации в БД!
    public function save($table)
    {
        $tbl = R::dispense($table);
        foreach ($this->attributes as $name => $value) {
            $tbl->$name = $value;
        }
        return R::store($tbl);
    }

    //в моделях и контроллерах никаких тегов HTML быть не должно!!!! - это истключение
    public function getErrors()
    {
        $errors = '<ul>';
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li>$item</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;
    }
}
