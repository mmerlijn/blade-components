@props(['theme'=>'default'])
<div {{ $attributes->merge(['class' => 'p-4 rounded-sm shadow-sm '.
\mmerlijn\bladeComponents\helpers\BladeTheme::getThemeBackground($theme)." ".
\mmerlijn\bladeComponents\helpers\BladeTheme::getThemeText($theme)])}}>{{$slot}}</div>