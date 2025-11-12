@props(['active'])

@php
$commonClasses = 'flex items-center gap-3 w-full h-11 rounded-lg px-4 font-semibold transition-all duration-200';

$conditionalClasses = ($active ?? false)
    ? 'bg-blue-50 text-blue-700'
    : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600';

$classes = $commonClasses . ' ' . $conditionalClasses;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>