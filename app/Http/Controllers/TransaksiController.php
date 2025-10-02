<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $spareparts = Sparepart::where('stok', '>', 0)->latest()->get();
        return view('user.index', compact('spareparts'));
    }

    public function beli($id)
    {
        $sparepart = Sparepart::findOrFail($id);

        if ($sparepart->stok < 1) {
            return back()->with('error', 'Stok habis!');
        }

        // Kurangi stok
        $sparepart->stok -= 1;
        $sparepart->save();

        // Simpan transaksi
        Transaksi::create([
            'user_id'      => Auth::id(),
            'sparepart_id' => $sparepart->id,
            'jumlah'       => 1,
            'total'        => $sparepart->harga, // pastikan ada kolom harga di sparepart
        ]);

        return redirect('/user')->with('success', 'Pembelian berhasil!');
    }

    public function riwayat()
    {
        $data = Transaksi::where('user_id', Auth::id())
            ->with('sparepart')
            ->latest()
            ->get();

        return view('user.riwayat', compact('data'));
    }
}
