@extends('layouts.index')

@section('content')
<div class="mb-4">
    <h2 class="text-xl font-bold">Laporan Jumlah Pernikahan per User</h2>
    <div class="flex flex-wrap gap-4 items-center mb-4">
        <!-- Dropdown Tahun -->
        <form method="GET" class="flex items-center gap-2">
            <label for="tahun" class="text-sm font-medium text-gray-700">Tahun:</label>
            <select name="tahun" id="tahun" onchange="this.form.submit()"
                class="border-gray-300 text-sm rounded px-2 py-1 focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($list_tahun as $thn)
                <option value="{{ $thn }}" {{ $tahun == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                @endforeach
            </select>
        </form>

        <!-- Tombol Export PDF -->
        <form action="{{ route('laporan.user.pdf') }}" method="GET" target="_blank">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-3 py-1.5 rounded shadow-sm flex items-center gap-1">
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
                <th class="px-4 py-2 border">NIP</th>
                <th class="px-4 py-2 border">Nama Operator</th>
                <th class="px-4 py-2 border">Kecamatan</th>
                <th class="px-4 py-2 border">Jumlah Pernikahan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
            <tr>
                <td class="px-4 py-2 border">{{ $item->nip }}</td>
                <td class="px-4 py-2 border">{{ $item->nama_pengguna }}</td>
                <td class="px-4 py-2 border">{{ $item->nama_kecamatan }}</td>
                <td class="px-4 py-2 border">{{ $item->jumlah }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center px-4 py-2 border">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection