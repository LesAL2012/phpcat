<?php

namespace fw\core\base;

class View
{
    //текущий маршрут
    public $route = [];

    //текущий вид
    public $view;

    //текущий шаблон
    public $layout;

    //пользовательские скрипты из вида
    public $scripts = [];

    //мета-теги
    public static $meta = ['title' => '', 'description' => '', 'keywords' => ''];

    public function __construct($route, $layout = '', $view = '')
    {
        $this->route = $route;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
    }

    public function render($vars)
    {
        if (is_array($vars)) {
            extract($vars);
        }

        $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        ob_start();
        if (is_file($file_view)) {
            require $file_view;
        } else {
            echo "<p>Не найден вид <b>$file_view</b></p>";
        }
        $content = ob_get_clean();

        if (false !== $this->layout) {
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($file_layout)) {
                $content = $this->getScript($content);
                $scripts = [];
                if (!empty($this->scripts[0])) {
                    $scripts = $this->scripts[0];
                }
                require $file_layout;
            } else {
                echo "<p>LayOut not found <b>$file_layout</b></p>";
            }
        }
    }

    protected function getScript($content)
    {
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern, $content, $this->scripts);
        if (!empty($this->scripts)) {
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }

    public static function getMeta()
    {
        if (self::$meta['title'] != '') {
            echo "<title>" . self::$meta['title'] . "</title>";
        } else {
            echo "<title>TITLE::</title>";
        }

        if (self::$meta['description'] != '') {
            echo " \n\t";
            echo '<meta name="description" content="' . self::$meta['description'] . '">';
        }

        if (self::$meta['keywords'] != '') {
            echo " \n\t";
            echo '<meta name="keywords" content="' . self::$meta['keywords'] . '">';
        }
    }

    public static function setMeta($title = '', $description = '', $keywords = '')
    {
        self::$meta['title'] = $title;
        self::$meta['description'] = $description;
        self::$meta['keywords'] = $keywords;
    }
}