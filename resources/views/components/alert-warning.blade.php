<!-- Toast Notification Warning -->
<div class="flex items-center bg-yellow-500 border-l-4 border-yellow-700 py-2 px-3 shadow-md mb-2 rounded">
    <!-- icons -->
    <div class="text-yellow-600 rounded-full bg-white mr-3">
        <svg width="1.8em" height="1.8em" viewBox="0 0 16 16" class="bi bi-exclamation" fill="currentColor"
             xmlns="http://www.w3.org/2000/svg">
            <path
                d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
        </svg>
    </div>
    <!-- message -->
    <div {{ $attributes->merge(['class' => 'text-white w-full'])}}>
        {{$slot}}
    </div>
</div>
