@props(['post'=>false])
@if($post)
    <form method="POST" {{$attributes}} role="none">
        <button type="submit"
                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                role="menuitem">
            {{$slot}}
        </button>
    </form>
@else
    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
       role="menuitem" {{$attributes}}>{{$slot}}</a>
@endif