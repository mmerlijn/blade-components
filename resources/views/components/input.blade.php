@props(['type' => 'text', 'name','value'=>null,'disabled' => false])
@php
    $classes = $errors->first($name)
    ? "mt-1 focus:ring-indigo-200 focus:border-indigo-300 focus:ring-opacity-50 block w-full shadow-sm sm:text-sm rounded-md border-red-600"
    : "mt-1 focus:ring-indigo-200 focus:border-indigo-300 focus:ring-opacity-50 block w-full shadow-sm sm:text-sm rounded-md border-gray-300 ";
@endphp
<input type="{{$type??'text'}}" name="{{$name}}" id="{{$name}}" value="{{old($name)?:$value??''}}"
       autocomplete="off" {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge(['class' => $classes]) !!}>