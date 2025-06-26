@props(['icon' => '', 'label' => '', 'value' => 0, 'percent' => null])

<div class="bg-white shadow rounded p-4">
    <div class="flex items-center justify-between">
        <div class="text-2xl">{{ $icon }}</div>
        <div class="text-right">
            <div class="text-sm font-semibold">{{ $label }}</div>
            <div class="text-xl font-bold">{{ number_format($value) }}</div>
            @if ($percent !== null)
            <div class="text-xs text-gray-500">{{ number_format($percent, 1) }}%</div>
            @endif
        </div>
    </div>
</div>