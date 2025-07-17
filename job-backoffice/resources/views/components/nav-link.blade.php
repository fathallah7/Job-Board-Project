@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'mb-4 flex items-center px-4 py-2 w-full text-md font-medium text-indigo-700 bg-indigo-50 rounded-lg transition hover:bg-indigo-100'
        : 'mb-4 flex items-center px-4 py-2 w-full text-md font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>
