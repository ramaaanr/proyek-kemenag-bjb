@extends('layouts.index')

@section('content')
<div class="mb-4">
    <h2 class="text-xl font-bold">Laporan Pendidikan Pasangan per Kelurahan</h2>
    <div class="flex items-center mb-4 gap-4 flex-wrap">

        <form method="GET" class="flex items-center gap-2 mb-4 flex-wrap">
            <label for="tahun" class="text-sm font-medium text-gray-700">Tahun:</label>
            <select name="tahun" id="tahun" onchange="this.form.submit()"
                class="border-gray-300 text-sm rounded px-2 py-1 focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($list_tahun as $thn)
                <option value="{{ $thn }}" {{ $tahun == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                @endforeach
            </select>
        </form>
        @if ($data->count())
        <form action="{{ route('laporan.pendidikan.pdf') }}" method="GET" target="_blank" class="mb-4">
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

<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-300 text-xs">
        <thead class="bg-gray-100">
            <tr>
                <th rowspan="2" class="px-2 py-1 border">Kelurahan</th>
                <th rowspan="2" class="px-2 py-1 border">Jumlah</th>
                <th colspan="{{ count($pendidikanLevels) }}" class="px-2 py-1 border">Pendidikan Pria</th>
                <th colspan="{{ count($pendidikanLevels) }}" class="px-2 py-1 border">Pendidikan Perempuan</th>
            </tr>
            <tr>
                @foreach ($pendidikanLevels as $level)
                <th class="px-2 py-1 border">{{ $level }}</th>
                @endforeach
                @foreach ($pendidikanLevels as $level)
                <th class="px-2 py-1 border">{{ $level }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
            $total = [
            'jumlah_pernikahan' => 0,
            ];
            foreach ($pendidikanLevels as $level) {
            $total["pria_$level"] = 0;
            $total["perempuan_$level"] = 0;
            }
            @endphp

            @forelse ($data as $item)
            @php
            $total['jumlah_pernikahan'] += $item->jumlah_pernikahan;
            foreach ($pendidikanLevels as $level) {
            $total["pria_$level"] += $item->{'pria_'.$level};
            $total["perempuan_$level"] += $item->{'perempuan_'.$level};
            }
            @endphp
            <tr>
                <td class="px-2 py-1 border">{{ $item->nama_kelurahan }}</td>
                <td class="px-2 py-1 border">{{ $item->jumlah_pernikahan }}</td>
                @foreach ($pendidikanLevels as $level)
                <td class="px-2 py-1 border">{{ $item->{'pria_'.$level} }}</td>
                @endforeach
                @foreach ($pendidikanLevels as $level)
                <td class="px-2 py-1 border">{{ $item->{'perempuan_'.$level} }}</td>
                @endforeach
            </tr>
            @empty
            <tr>
                <td colspan="{{ 2 + count($pendidikanLevels)*2 }}" class="text-center px-2 py-1 border">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>

        <tfoot class="font-bold bg-gray-50">
            <tr>
                <td class="px-2 py-1 border text-right">Total</td>
                <td class="px-2 py-1 border">{{ $total['jumlah_pernikahan'] }}</td>
                @foreach ($pendidikanLevels as $level)
                <td class="px-2 py-1 border">{{ $total["pria_$level"] }}</td>
                @endforeach
                @foreach ($pendidikanLevels as $level)
                <td class="px-2 py-1 border">{{ $total["perempuan_$level"] }}</td>
                @endforeach
            </tr>
        </tfoot>

    </table>
</div>
@endsection