<?php


namespace mmerlijn\bladeComponents\View\Components;


use mmerlijn\bladeComponents\helpers\HasTheme;

class Panel extends \Illuminate\View\Component
{
    use HasTheme;

    public $title;

    public function __construct($title,$theme='default'){
        $this->title = $title;
        $this->theme = $theme;
    }
    public function render()
    {
        return view('bladeComponents::components.panel');
    }
}