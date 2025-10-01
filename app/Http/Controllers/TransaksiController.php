<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;

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

        $sparepart->stok -= 1;
        $sparepart->save();

        return redirect('/user')->with('success', 'Pembelian berhasil!');
    }

    public function riwayat()
    {
        $data = [];
        return view('user.riwayat', compact('data'));
    }
}
