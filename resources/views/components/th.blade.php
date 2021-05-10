@props(['color'=>'gray'])
<th scope="col" {{$attributes->merge(['class'=> "px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-".$color."-800" ])}}>{{$slot}}</th>
