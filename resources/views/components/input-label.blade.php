@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-xs font-semibold text-neutral-500 uppercase tracking-wider']) }}>
    {{ $value ?? $slot }}
</label>
