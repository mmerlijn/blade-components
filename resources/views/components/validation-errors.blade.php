@props(['color'=>'red'])
@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-{{$color}}-600">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif