@props(['color'=>'gray'])
<div {{ $attributes->merge(['class' => 'p-4 rounded-sm shadow-sm bg-'.$color.'-100 text-'.$color.'-800'])}}>{{$slot}}</div>