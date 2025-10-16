<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function index()
    {
        // Ambil total pendapatan harian (7 hari terakhir)
        $harian = Transaksi::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('SUM(total) as total_pendapatan')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->take(7)
            ->get();

        // Siapkan data untuk Chart.js
        $labels = $harian->pluck('tanggal')->map(function ($tgl) {
            return date('d M', strtotime($tgl));
        });

        $pendapatanData = $harian->pluck('total_pendapatan');

        // Total semua pendapatan
        $totalPendapatan = Transaksi::sum('total');

        return view('admin.statistik', compact('labels', 'pendapatanData', 'totalPendapatan'));
    }
}
