@props(['name'=>false])
<label @if($name)for="{{$name??''}}" @endif {{ $attributes->merge(['class' => 'block font-bold text-gray-700'])}}>
    {{$slot}}
</label>
