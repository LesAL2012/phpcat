<?php

namespace fw\core;

class Router
{

    //таблица маршрутов
    protected static $routes = [];
    //текущий маршрут
    protected static $route = [];

    //добавляет маршрут в таблицу маршрутов
    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    //возвращает таблицу маршрутов
    public static function getRoutes()
    {
        return self::$routes;
    }

    //возвращает текущий маршрут
    public static function getRoute()
    {
        return self::$route;
    }

    //ищет URL в таблице маршрутов
    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                $route['action'] = self::lowerCamelCase($route['action']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    //перенаправляет URL по корректному маршруту
    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
            if (class_exists($controller)) {
                $cObj = new $controller(self::$route);
                $action = self::$route['action'] . 'Action';
                if (method_exists($cObj, $action)) {
                    $cObj->$action();
                    $cObj->getView();
                } else {
                    throw new \Exception("Method '<b>$controller::$action</b>' not found", 404);
                }
            } else {
                throw new \Exception("Controller '<b>$controller</b>' not found", 404);
            }
        } else {
            throw new \Exception("Page not found", 404);
        }

    }

    //название контроллера из строки запроса posts-new переводим в PostsNew
    protected static function upperCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    //название экшена из строки запроса test-page переводим в testPage
    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }

    protected static function removeQueryString($url)
    {
        if ($url) {
            $params = explode('&', $url, 2);
            if (false === strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
        }
    }
}
