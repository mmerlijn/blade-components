@props(['theme'=>'default'])
<th scope="col" {{$attributes->merge(['class'=> "px-6 py-3 text-left text-xs font-medium uppercase tracking-wider ".\mmerlijn\bladeComponents\helpers\BladeTheme::getThemeText($theme) ])}}>
    {{$slot}}
</th>