<?php

namespace mmerlijn\bladeComponents\helpers;

trait HasTheme
{
    public $theme;
    public function theme($key = null)
    {
        $key = $key ? $this->theme.'.'.$key : $this->theme;

        return config("blade-components.components.{$this->componentName}.themes.".$key);
    }
}