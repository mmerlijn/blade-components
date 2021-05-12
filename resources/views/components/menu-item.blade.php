@props(['post'=>false])
@if($post)
    <form method="post" {{$attributes}} >
        @csrf
        <button type="submit"
                class="inline-block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
            {{$slot}}
        </button>
    </form>
@else
    <a class="inline-block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
       {{$attributes}}>{{$slot}}</a>
@endif