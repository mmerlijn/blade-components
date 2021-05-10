@props(['name','options'=> [],'align'=>'vertical'])
<fieldset>
    @if($align=='vertical')
        @foreach($options as $k=>$option)
            <div class="flex items-center">
                <input id="{{$k}}" name="{{$name}}" type="radio" {{$attributes}}>
                <label for="{{$k}}" class="ml-3 block text-sm font-medium text-gray-700">
                    {{$option}}
                </label>
            </div>
        @endforeach
    @else
        <div class="flex items-center">
            @foreach($options as $k=>$option)
                <input id="{{$k}}" name="{{$name}}" type="radio" {{$attributes}}>
                <label for="{{$k}}" class="ml-3 block text-sm font-medium text-gray-700">
                    {{$option}}
                </label>
            @endforeach
        </div>
    @endif
</fieldset>
