@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-2 border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:border-red-500 focus:ring-2 focus:ring-red-500/50 rounded-lg shadow-sm outline-none transition',
]) !!}>
