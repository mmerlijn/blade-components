@props(['name','disabled' => false,'cols'=>30,'rows'=>4,'disabled' => false])
@php
    $classes = $errors->first($name)
    ? "rounded border-red-600"
    : "rounded border-gray-300 ";
@endphp
<textarea name="{{$name}}" id="{{$name}}" cols="{{$cols}}" rows="{{$rows}}" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }}>{{$slot}}</textarea>