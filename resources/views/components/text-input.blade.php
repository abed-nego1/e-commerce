@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'mt-1.5 block w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-gray-900 text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:border-neutral-900 focus:ring-4 focus:ring-neutral-100 transition-all duration-200']) !!}>
