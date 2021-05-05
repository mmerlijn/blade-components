@isset($link)
    <a href="{{$link}}">
        @endisset
        @switch($type??"")
            @case('success')
            <button {{ $attributes->merge(['class' => 'bg-green-600 text-white rounded-lg hover:bg-green-400 hover:text-gray-300 p-2 shadow-lg']) }}>{{$slot}}</button>
            @break
            @default
            <button {{ $attributes->merge(['class' => 'bg-blue-600 text-white rounded-lg hover:bg-blue-400 hover:text-gray-300 p-2 shadow-lg']) }} >{{$slot}}</button>
        @endswitch
        @isset($link)
    </a>
@endisset
