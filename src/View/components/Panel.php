<?php


namespace mmerlijn\bladeComponents\View\Components;


use mmerlijn\bladeComponents\helpers\HasTheme;

class Panel extends \Illuminate\View\Component
{
    use HasTheme;
    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('bladeComponents::components.panel');
    }
}