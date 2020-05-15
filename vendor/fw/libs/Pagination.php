<?php

namespace fw\libs;

class Pagination
{

    public $perPage;
    public $total;
    public $countPages;
    public $currentPage;
    public $uri;

    public function __construct($page, $perpage, $total)
    {
        $this->perPage = $perpage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }

    public function __toString()
    {
        return $this->getHtml();
    }

    public function getHtml()
    {
        $back = null; // назад
        $forward = null; // вперед
        $startPage = null; // в начало
        $endPage = null; // в конец
        $page4left = null; // четвертая слева
        $page3left = null; // третья слева
        $page2left = null; // вторая слева
        $page1left = null; // первая слева
        $page3right = null; // третья справа
        $page2right = null; // вторая справа
        $page1right = null; // первая справа

        if ($this->currentPage > 1) {
            $back = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" . ($this->currentPage - 1) . "'>&lt;</a></li>";
        }
        if ($this->currentPage < $this->countPages) {
            $forward = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" . ($this->currentPage + 1) . "'>&gt;</a></li>";
        }
        if ($this->currentPage > 3) {
            $startPage = "<li class='page-item'><a class='page-link' href='{$this->uri}page=1'>&laquo;</a></li>";
        }
        if ($this->currentPage < ($this->countPages - 2)) {
            $endPage = "<li class='page-item'><a class='page-link' href='{$this->uri}page={$this->countPages}'>&raquo;</a></li>";
        }
        if ($this->currentPage - 4 > 0) {
            $page4left = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" . ($this->currentPage - 4) . "'>" . ($this->currentPage - 4) . "</a></li>";
        }
        if ($this->currentPage - 3 > 0) {
            $page3left = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" . ($this->currentPage - 3) . "'>" . ($this->currentPage - 3) . "</a></li>";
        }
        if ($this->currentPage - 2 > 0) {
            $page2left = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" . ($this->currentPage - 2) . "'>" . ($this->currentPage - 2) . "</a></li>";
        }
        if ($this->currentPage - 1 > 0) {
            $page2left = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" . ($this->currentPage - 1) . "'>" . ($this->currentPage - 1) . "</a></li>";
        }
        if ($this->currentPage + 1 <= $this->countPages) {
            $page1right = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" . ($this->currentPage + 1) . "'>" . ($this->currentPage + 1) . "</a></li>";
        }
        if ($this->currentPage + 2 <= $this->countPages) {
            $page2right = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" . ($this->currentPage + 2) . "'>" . ($this->currentPage + 2) . "</a></li>";
        }
        if ($this->currentPage + 3 <= $this->countPages) {
            $page3right = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" . ($this->currentPage + 3) . "'>" . ($this->currentPage + 3) . "</a></li>";
        }

        return '<ul class="pagination justify-content-center">' . $startPage . $back . $page4left . $page3left . $page2left . $page1left . '<li class="page-item active"><a class="page-link">' . $this->currentPage . '</a></li>' . $page1right . $page2right . $page3right . $forward . $endPage . '</ul>';
    }

    public function getCountPages()
    {
        return ceil($this->total / $this->perPage) ?: 1;
    }

    public function getCurrentPage($page)
    {
        if (!$page || $page < 1) {
            $page = 1;
        };
        if ($page > $this->countPages) {
            $page = $this->countPages;
        };
        return $page;
    }

    public function getStart()
    {
        return ($this->currentPage - 1) * $this->perPage;
    }

    public function getParams()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0] . '?';
        if (isset($url[1]) && $url[1] != '') {
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                if (!preg_match("#page=#", $param)) $uri .= "{$param}&amp;";
            }
        }
        return $uri;
    }
}