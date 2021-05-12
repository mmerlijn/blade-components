@props(['active','color'=>'indigo'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-1 pt-1 border-b-2 border-'.$color.'-400 font-medium leading-5 text-'.$color.'-900 focus:outline-none focus:border-'.$color.'-700 transition'
                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent font-medium leading-5 text-'.$color.'-500 hover:text-'.$color.'-700 hover:border-'.$color.'-300 focus:outline-none focus:text-'.$color.'-700 focus:border-'.$color.'-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>