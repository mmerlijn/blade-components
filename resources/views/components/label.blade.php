@props(['name'=>false,'value'])
<label @if($name)for="{{$name??''}}" @endif {{ $attributes->merge(['class' => 'block text-sm font-medium text-gray-700'])}}>{{$value}}</label>