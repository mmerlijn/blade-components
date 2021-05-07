<span {{ $attributes->merge(['class' => $getThemeClasses()]) }}>
  {{ $slot }}
    {{config("blade-components.components.badge.themes.default")}}
</span>