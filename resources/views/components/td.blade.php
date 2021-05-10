@props(['color'=>'gray'])
<td {{$attributes->merge(['class'=> "px-6 py-4 whitespace-nowrap text-".$color."-800"])}}>{{$slot}}</td>
