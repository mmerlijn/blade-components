@props(['name','label'=>'','disabled' => false])
<div class="flex items-center">
    <input name="{{$name}}" id="{{$name}}" {{ $disabled ? 'disabled' : '' }}
           type="checkbox" {{$attributes}}>
    <label class="ml-3 block text-sm font-medium text-gray-700" for="{{$name}}">{{$label}}</label>
</div>
