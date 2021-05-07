<?php

namespace mmerlijn\bladeComponents\helpers;

trait HasTheme
{
    public $theme='default';

    public function getThemeClasses()
    {
        return config("blade-components.components.".$this->componentName.".themes.".$this->theme);
    }
}