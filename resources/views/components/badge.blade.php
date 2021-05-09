@props(['theme'=>'default'])
<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded-full font-medium ".
    \mmerlijn\bladeComponents\helpers\BladeTheme::getThemeBackground($theme)." ".
    \mmerlijn\bladeComponents\helpers\BladeTheme::getThemeText($theme)]) }}>
  {{ $slot }}
</span>