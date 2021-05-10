@props(['name','options'=>[],'value'=>''])
@php
    $classes = $errors->first($name)
    ? "border-red-600"
    : "border-gray-300 ";
@endphp
<select id="{{$name}}" name="{{$name}}" autocomplete="off" {{ $attributes->merge(['class' => $classes]) }}>
    @foreach($options as $k=>$option)
        <option value="{{$k}}" @if($value==$k) selected @endif>{{$option}}</option>
    @endforeach
</select>