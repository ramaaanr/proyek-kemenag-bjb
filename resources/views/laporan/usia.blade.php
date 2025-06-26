@extends('layouts.index')

@section('content')
<div class="mb-4">
    <h2 class="text-xl font-bold">Laporan Usia Pasangan Pernikahan per Kelurahan</h2>

    <div class="flex items-center mb-4 gap-4 flex-wrap">
        <form method="GET" class="flex items-center gap-2">
            <label for="tahun" class="text-sm font-medium text-gray-700">Tahun:</label>
            <select name="tahun" id="tahun" onchange="this.form.submit()"
                class="border-gray-300 text-sm rounded px-2 py-1 focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($list_tahun as $thn)
                <option value="{{ $thn }}" {{ $tahun == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                @endforeach
            </select>
        </form>

        <form action="{{route('laporan.usia.pdf')}}" method="GET" target="_blank">
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
        <thead class="bg-gray-100 text-center">
            <tr>
                <th rowspan="2" class="px-3 py-2 border">Kelurahan</th>
                <th rowspan="2" class="px-3 py-2 border">Jumlah Pernikahan</th>
                <th colspan="4" class="px-3 py-2 border">Usia Laki-laki</th>
                <th colspan="4" class="px-3 py-2 border">Usia Perempuan</th>
            </tr>
            <tr>
                <th class="px-2 py-1 border">&lt;19</th>
                <th class="px-2 py-1 border">19–21</th>
                <th class="px-2 py-1 border">22–30</th>
                <th class="px-2 py-1 border">&gt;30</th>

                <th class="px-2 py-1 border">&lt;19</th>
                <th class="px-2 py-1 border">19–21</th>
                <th class="px-2 py-1 border">22–30</th>
                <th class="px-2 py-1 border">&gt;30</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
            <tr class="text-center">
                <td class="px-2 py-1 border">{{ $item->nama_kelurahan }}</td>
                <td class="px-2 py-1 border">{{ $item->total }}</td>

                <td class="px-2 py-1 border">{{ $item->laki_u19 }}</td>
                <td class="px-2 py-1 border">{{ $item->laki_19_21 }}</td>
                <td class="px-2 py-1 border">{{ $item->laki_22_30 }}</td>
                <td class="px-2 py-1 border">{{ $item->laki_o30 }}</td>

                <td class="px-2 py-1 border">{{ $item->perempuan_u19 }}</td>
                <td class="px-2 py-1 border">{{ $item->perempuan_19_21 }}</td>
                <td class="px-2 py-1 border">{{ $item->perempuan_22_30 }}</td>
                <td class="px-2 py-1 border">{{ $item->perempuan_o30 }}</td>
            </tr>


            @empty
            <tr>
                <td colspan="10" class="text-center px-4 py-2 border">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
        @php
        $total = [
        'pernikahan' => $data->sum('total'),
        'laki_u19' => $data->sum('laki_u19'),
        'laki_19_21' => $data->sum('laki_19_21'),
        'laki_22_30' => $data->sum('laki_22_30'),
        'laki_o30' => $data->sum('laki_o30'),
        'perempuan_u19' => $data->sum('perempuan_u19'),
        'perempuan_19_21' => $data->sum('perempuan_19_21'),
        'perempuan_22_30' => $data->sum('perempuan_22_30'),
        'perempuan_o30' => $data->sum('perempuan_o30'),
        ];
        @endphp
        <tr class="font-bold bg-gray-200 text-center">
            <td class="px-2 py-1 border">Total</td>
            <td class="px-2 py-1 border">{{ $total['pernikahan'] }}</td>
            <td class="px-2 py-1 border">{{ $total['laki_u19'] }}</td>
            <td class="px-2 py-1 border">{{ $total['laki_19_21'] }}</td>
            <td class="px-2 py-1 border">{{ $total['laki_22_30'] }}</td>
            <td class="px-2 py-1 border">{{ $total['laki_o30'] }}</td>
            <td class="px-2 py-1 border">{{ $total['perempuan_u19'] }}</td>
            <td class="px-2 py-1 border">{{ $total['perempuan_19_21'] }}</td>
            <td class="px-2 py-1 border">{{ $total['perempuan_22_30'] }}</td>
            <td class="px-2 py-1 border">{{ $total['perempuan_o30'] }}</td>
        </tr>
    </table>
</div>
@endsection