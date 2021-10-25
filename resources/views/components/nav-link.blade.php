@props(['active'])

    @php
        $classes = ($active ?? false)
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-blue-400 text-sm font-medium leading-5 text-primary
        focus:outline-none focus:border-blue-700 transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-700
        hover:text-primary hover:border-blue-400 focus:outline-none focus:text-primary focus:border-blue-700
        transition duration-150 ease-in-out';
    @endphp

    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
