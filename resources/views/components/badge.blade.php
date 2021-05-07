<span {{ $attributes->merge(['class' => $getTheme()]) }}>
  {{ $slot }}
    {{config("blade-components.components.badge.themes.default")}}
</span>