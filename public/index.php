<?php

use fw\core\Router;

$query = rtrim($_SERVER['QUERY_STRING'], '/');

define("DEBUG", 1); // 1/0 показывать-отладка/скрывать ошибки(продакшн) - разработка или продакшн
define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/fw/core');
define('ROOT', dirname(__DIR__));
define('LIBS', dirname(__DIR__) . '/vendor/fw/libs');
define('APP', dirname(__DIR__) . '/app');
define('CACHE', dirname(__DIR__) . '/tmp/cache');
define('LAYOUT', 'default');

require '../vendor/fw/libs/functions.php';

// автозагрузка контроллеров
require_once(__DIR__ . '/../vendor/autoload.php');

// объект реестра
new \fw\core\App;

//default routs
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);
