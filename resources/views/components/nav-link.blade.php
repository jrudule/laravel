@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:hover:text-white/80 dark:focus-visible:ring-white bg-slate-700 h-max transition duration-150 ease-in-out'
            : 'inline-flex items-center  rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:hover:text-white/80 dark:focus-visible:ring-white bg-slate-700/80 h-max transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
