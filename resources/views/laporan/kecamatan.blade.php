@extends('layouts.index')

@section('content')
<div class="mb-4">
    <h2 class="text-xl font-bold">Laporan Pernikahan per Kelurahan</h2>
    <div class="flex flex-wrap items-end gap-4 mb-4">
        <!-- Filter Kecamatan dan Tahun -->
        <form method="GET" class="flex items-center gap-2 flex-wrap">
            <label for="id_kecamatan" class="text-sm font-medium text-gray-700">Kecamatan:</label>
            <select name="id_kecamatan" id="id_kecamatan" onchange="this.form.submit()"
                class="border-gray-300 text-sm rounded px-2 py-1 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">-- Pilih Kecamatan --</option>
                @foreach($kecamatan as $kec)
                <option value="{{ $kec->id }}" {{ $id_kecamatan == $kec->id ? 'selected' : '' }}>
                    {{ $kec->nama_kecamatan }}
                </option>
                @endforeach
            </select>

            <label for="tahun" class="text-sm font-medium text-gray-700">Tahun:</label>
            <select name="tahun" id="tahun" onchange="this.form.submit()"
                class="border-gray-300 text-sm rounded px-2 py-1 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">-- Pilih Tahun --</option>
                @foreach($list_tahun as $thn)
                <option value="{{ $thn }}" {{ $tahun == $thn ? 'selected' : '' }}>
                    {{ $thn }}
                </option>
                @endforeach
            </select>
        </form>

        <!-- Tombol Export PDF -->
        @if($id_kecamatan && $tahun)
        <form action="{{ route('laporan.kecamatan.pdf') }}" method="GET" target="_blank">
            <input type="hidden" name="id_kecamatan" value="{{ $id_kecamatan }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-3 py-1.5 rounded shadow-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-base">picture_as_pdf</span>
                Export PDF
            </button>
        </form>
        @endif
    </div>
</div>

@if($data->count())
<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-300 text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="text-left px-4 py-2 border">Kelurahan</th>
                <th class="text-left px-4 py-2 border">Jumlah Pernikahan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td class="px-4 py-2 border">{{ $item->nama_kelurahan }}</td>
                <td class="px-4 py-2 border">{{ $item->jumlah }}</td>
            </tr>
            @endforeach
            <tr class="font-bold bg-gray-50">
                <td class="px-4 py-2 border text-right">Total</td>
                <td class="px-4 py-2 border">{{ $total }}</td>
            </tr>
        </tbody>
    </table>
</div>
@else
<p class="text-gray-600">Silakan pilih kecamatan dan tahun untuk melihat data.</p>
@endif
@endsection