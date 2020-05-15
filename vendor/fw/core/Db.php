<?php

namespace fw\core;

use \RedBeanPHP\R;

/**
 * Singleton - only one instance from class Db
 */
class Db
{
    use TraitSingleton;

    public static $countSql = 0;
    public static $queries = [];

    protected function __construct()
    {
        $db = require ROOT . '/config/config_db.php';

        R::setup($db['dsn'], $db['username'], $db['password']);

        if(!R::testConnection()){
            $out = '<h1>No database connection!</h1>';
            $out .= '<p>Check SERVER or configuration settings...</p>';
            echo $out;
            die;
        }

        R::freeze(true);
    }
}