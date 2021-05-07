@props(['type' => 'text', 'name','label','value'])
<div {{ $attributes->merge(['class' => 'col-span-6 sm:col-span-4'])}} >
    @if($label)
    <label for="{{$name}}" class="block text-sm font-medium text-gray-700">{{$label}}</label>
    @endif
    <input type="{{$type??'text'}}" name="{{$name}}" id="{{$name}}" value="{{old($name)?:$value??''}}" autocomplete="off"
           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error($name) border border-red-600 @enderror">
</div>