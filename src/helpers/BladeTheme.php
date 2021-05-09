<?php


namespace mmerlijn\bladeComponents\helpers;


class BladeTheme
{
    public static function getThemeBackground($theme='default'){
        return config('blade-components.themes.'.$theme.'.background');
    }
    public static function getThemeText($theme='default'){
        return config('blade-components.themes.'.$theme.'.text');
    }
}