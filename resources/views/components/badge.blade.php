<span {{ $attributes->merge(['class' => $getThemeClasses(). " ".$getThemeText()." ".$getThemeBackground()]) }}>
  {{ $slot }}
</span>