<?php

namespace app\controllers;

class AppController extends \fw\core\base\Controller
{
    public $meta = [];

    public function __construct($route)
    {
        parent::__construct($route);
    }
}
