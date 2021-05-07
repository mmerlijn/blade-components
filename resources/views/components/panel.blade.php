<div {{ $attributes->merge(['class' => 'shadow-lg rounded-lg overflow-auto'])->filter(fn($v,$k)=>$k !=='title') }}>
    <div class="{{$getThemeBackground()}}">
        <h1 class="text-xl font-bold py-2 px-4 {{$getThemeText()}}">{{$title}}</h1>
    </div>
<div class="p-4">
    {{$slot}}
</div>
</div>
