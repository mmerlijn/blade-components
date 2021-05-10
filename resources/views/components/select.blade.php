@props(['name','options'=>[],'value'=>'','disabled' => false])
@php
    $classes = $errors->first($name)
    ? "rounded border-red-600"
    : "rounded border-gray-300 ";
@endphp
<select id="{{$name}}" name="{{$name}}" {{ $disabled ? 'disabled' : '' }} autocomplete="off" {{ $attributes->merge(['class' => $classes]) }}>
    @foreach($options as $k=>$option)
        <option value="{{$k}}" @if($value==$k) selected @endif>{{$option}}</option>
    @endforeach
</select>