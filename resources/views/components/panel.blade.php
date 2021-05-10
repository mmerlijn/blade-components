@props(['title'=>'','color'=>'gray'])
<div {{ $attributes->merge(['class' => 'shadow-lg rounded-lg overflow-auto'])->filter(fn($v,$k)=>$k !=='title') }}>
    <div class="bg-{{$color}}-100">
        <h1 class="text-xl font-bold py-2 px-4 text-{{$color}}-800">{{$title}}</h1>
    </div>
    <div class="p-4">
        {{$slot}}
    </div>
</div>
