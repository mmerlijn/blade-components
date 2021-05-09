@props(['name','label'=>''])
<input name="{{$name}}" id="{{$name}}" type="checkbox" {!! $attributes->merge(['class' => 'rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>
<label class="ml-3 block text-sm font-medium text-gray-700" for="{{$name}}">{{$label}}</label>