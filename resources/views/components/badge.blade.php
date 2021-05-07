<span {{ $attributes->merge(['class' => $getThemeClasses()]) }}>
  {{ $slot }}
    {{$getThemeClasses()}}
</span>