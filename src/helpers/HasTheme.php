<?php

namespace mmerlijn\bladeComponents\helpers;

trait HasTheme
{
    public $theme='default';

    public function getThemeClasses()
    {
        return config("blade-components.components.".strtolower(substr(__CLASS__, strrpos(__CLASS__, '\\') + 1)).".class");
    }
    public function getThemeText()
    {
        return config("blade-components.themes.".$this->theme.".text");
    }
    public function getThemeBackground()
    {
        return config("blade-components.themes.".$this->theme.".background");
    }
}