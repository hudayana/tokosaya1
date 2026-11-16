@props(['status'])

@php
    $statusLabels = [
        'pending' => 'Pending',
        'diproses' => 'Diproses',
        'dikirim' => 'Dikirim',
        'selesai' => 'Selesai',
        'dibatalkan' => 'Dibatalkan',
    ];
    $statusClasses = [
        'pending' => 'bg-yellow-100 text-yellow-800',
        'diproses' => 'bg-blue-100 text-blue-800',
        'dikirim' => 'bg-indigo-100 text-indigo-800',
        'selesai' => 'bg-green-100 text-green-800',
        'dibatalkan' => 'bg-red-100 text-red-800',
    ];
    $label = $statusLabels[$status] ?? ucfirst($status);
    $classes = $statusClasses[$status] ?? 'bg-gray-100 text-gray-800';
@endphp

<span {{ $attributes->class(['inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold', $classes]) }}>
    {{ $label }}
</span>
