<?php
namespace mmerlijn\bladeComponents\View\Components;

use Illuminate\View\Component;
use mmerlijn\bladeComponents\helpers\HasTheme;

class Badge extends Component
{
    use HasTheme;

    public $var="bg-red-300";
    public function __construct($theme = 'default')
    {
        $this->theme = $theme;
    }

    public function render()
    {
        return view('bladeComponents::components.badge');
    }
}