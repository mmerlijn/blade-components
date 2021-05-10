@props(['type' => 'text', 'name','value'=>null,'disabled' => false])
@php
    $classes = $errors->first($name)
    ? "rounded border-red-600"
    : "rounded border-gray-300 ";
@endphp
<input type="{{$type??'text'}}" name="{{$name}}" id="{{$name}}" value="{{old($name)?:$value??''}}"
       autocomplete="off" {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge(['class' => $classes]) !!}>
