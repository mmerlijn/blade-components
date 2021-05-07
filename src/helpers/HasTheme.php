<?php

namespace mmerlijn\bladeComponents\helpers;

trait HasTheme
{
    public $theme='default';

    public function getThemeClasses()
    {
        return config("blade-components.components.".__CLASS__.".themes.".$this->theme)?:'name:'.strtolower(substr(__CLASS__, strrpos(__CLASS__, '\\') + 1));
    }
}