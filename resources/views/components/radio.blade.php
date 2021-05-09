@props(['name','options'=> [],'align'=>'vertical'])
<fieldset>
    @if($align=='vertical')
        @foreach($options as $k=>$option)
            <div class="flex items-center">
                <input id="{{$k}}" name="{{$name}}" type="radio"
                       class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                <label for="{{$k}}" class="ml-3 block text-sm font-medium text-gray-700">
                    {{$option}}
                </label>
            </div>
        @endforeach
    @else
        <div class="flex items-center">
            @foreach($options as $k=>$option)
                <input id="{{$k}}" name="{{$name}}" type="radio"
                       class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                <label for="{{$k}}" class="ml-3 block text-sm font-medium text-gray-700">
                    {{$option}}
                </label>
            @endforeach
        </div>
    @endif
</fieldset>
