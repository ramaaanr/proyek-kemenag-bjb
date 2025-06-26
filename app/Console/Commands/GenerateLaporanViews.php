<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateLaporanViews extends Command
{
    protected $signature = 'make:laporan-views';
    protected $description = 'Generate file view laporan secara otomatis';

    protected $viewNames = [
        'bulanan',
        'tahunan',
        'kecamatan',
        'usia',
        'tren',
        'peta',
        'user',
        'pendidikan',
    ];

    public function handle()
    {
        $viewPath = resource_path('views/laporan');

        // Buat folder jika belum ada
        if (!File::exists($viewPath)) {
            File::makeDirectory($viewPath, 0755, true);
            $this->info("📁 Folder 'views/laporan' dibuat.");
        }

        foreach ($this->viewNames as $view) {
            $file = $viewPath . "/{$view}.blade.php";

            if (!File::exists($file)) {
                File::put($file, $this->getStubContent($view));
                $this->info("✅ View '$view.blade.php' berhasil dibuat.");
            } else {
                $this->warn("⚠️  View '$view.blade.php' sudah ada, dilewati.");
            }
        }

        $this->info("🎉 Semua view laporan berhasil diproses.");
    }

    protected function getStubContent($view)
    {
        return <<<BLADE
@extends('layouts.index')

@section('content')
    <h2 class="text-xl font-bold mb-4 capitalize">Laporan {$view}</h2>
    <!-- Tambahkan konten laporan di sini -->
    <div class="bg-white shadow p-4 rounded">
        <p>Ini adalah halaman laporan <strong>{$view}</strong>.</p>
    </div>
@endsection
BLADE;
    }
}
