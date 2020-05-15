<?php


namespace fw\libs;


class Ckeditor
{
    protected $mainScript = "<script src='/ckeditor/ckeditor.js'></script>";

    protected function selectorScript($selector)
    {
        $out = "<script>";
        $out .= "CKEDITOR.replace( '{$selector}' );";
        $out .= "CKEDITOR.config.extraPlugins = '";

        $out .= "font, ";
        $out .= "colorbutton,";
        $out .= "justify,";

        //$out .= "";

        $out .= "';";


        $out .= "</script>";

        return $out;
    }

    public function getEditorFirst($selector)
    {
        $out = $this->mainScript;
        $out .= $this->selectorScript($selector);
        echo $out;
    }

    public function getEditorSecond($selector)
    {
        echo $this->selectorScript($selector);
    }
}





















