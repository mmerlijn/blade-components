@props(['color'=>'gray','href'=>''])
@if($href)
    <a href="{{$href}}">
        @endif
        <button {{($href)?"":"type='submit'"}} {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-'.$color.'-600 border border-transparent rounded-md text-white tracking-widest hover:bg-'.$color.'-500 active:bg-'.$color.'-800 focus:outline-none focus:border-'.$color.'-900 focus:ring focus:ring-'.$color.'-200 disabled:opacity-25 transition']) }}>
            {{ $slot }}
        </button>
        @if($href)
    </a>
@endif