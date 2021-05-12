@props(['href'=>"#"])
<div class="relative inline-block text-left">
    <div class="inline-flex justify-center w-full px-4 py-2 bg-white text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
        <a href="{{$href}}">
            {{$slot}}
        </a>
    </div>
</div>
