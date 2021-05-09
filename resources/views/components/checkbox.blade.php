@props(['name','label'=>''])
<input name="{{$name}}" id="{{$name}}" type="checkbox" {!! $attributes->merge(['class' => 'rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>
<bladeComponents::components.label for="{{$name}}">{{$label}}</bladeComponents::components.label>