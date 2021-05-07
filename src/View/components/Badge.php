<?php
namespace mmerlijn\bladeComponents\View\Components;

use Illuminate\View\Component;
use mmerlijn\bladeComponents\helpers\HasTheme;

class Badge extends Component
{
    use HasTheme;

    public function __construct($theme = 'default')
    {
        $this->theme = $theme;
    }

    public function render()
    {
        return view('blade-components::components.badge');
    }
}