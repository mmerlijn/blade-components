<?php

namespace mmerlijn\bladeComponents\helpers;

trait HasTheme
{
    public $theme='default';

    public function getThemeClasses($theme = null)
    {
        $theme = $theme ?: $this->theme;

        return config("blade-components.components.{$this->componentName}.themes.".$theme);
    }
}