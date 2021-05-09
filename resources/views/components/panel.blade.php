@props(['title'=>'','theme'=>'default'])
<div {{ $attributes->merge(['class' => 'shadow-lg rounded-lg overflow-auto'])->filter(fn($v,$k)=>$k !=='title') }}>
    <div class="@if($theme){{\mmerlijn\bladeComponents\helpers\BladeTheme::getThemeBackground($theme)}}@endif">
        <h1 class="text-xl font-bold py-2 px-4 @if($theme){{\mmerlijn\bladeComponents\helpers\BladeTheme::getThemeText($theme)}}@endif">{{$title}}</h1>
    </div>
    <div class="p-4">
        {{$slot}}
    </div>
</div>
