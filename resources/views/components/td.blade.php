@props(['theme'=>'default'])
<td {{$attributes->merge(['class'=> "px-6 py-4 whitespace-nowrap ".\mmerlijn\bladeComponents\helpers\BladeTheme::getThemeText($theme) ])}}>{{$slot}}</td>
