@extends('layouts.index')

@section('content')
<div class="mb-4">
    <h2 class="text-xl font-bold">Laporan Tahunan Pernikahan</h2>
    <div class="flex i mb-4 gap-4 flex-wrap">
        <!-- Tombol Export PDF -->
        <form action="{{ route('laporan.tahunan.pdf') }}" method="GET" target="_blank">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium px-3 py-1.5 rounded shadow-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-base">picture_as_pdf</span>
                Export PDF
            </button>
        </form>
    </div>

</div>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-300 text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="text-left px-4 py-2 border">Tahun</th>
                <th class="text-left px-4 py-2 border">Jumlah Pernikahan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
            <tr>
                <td class="px-4 py-2 border">{{ $item->tahun }}</td>
                <td class="px-4 py-2 border">{{ $item->jumlah }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="text-center px-4 py-2 border">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection