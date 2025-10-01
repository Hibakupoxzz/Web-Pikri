<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('sparepart')->where('user_id', Auth::id())->get();
        $total = $carts->sum(function($cart) {
            return $cart->sparepart->harga * $cart->jumlah;
        });

        return view('user.cart', compact('carts', 'total'));
    }

    public function add(Request $request, $id)
    {
        $sparepart = Sparepart::findOrFail($id);

        if ($sparepart->stok < 1) {
            return back()->with('error', 'Stok habis!');
        }

        $cart = Cart::where('user_id', Auth::id())
                    ->where('sparepart_id', $id)
                    ->first();

        if ($cart) {
            if ($cart->jumlah + 1 > $sparepart->stok) {
                return back()->with('error', 'Jumlah melebihi stok tersedia!');
            }
            $cart->jumlah += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'sparepart_id' => $id,
                'jumlah' => 1
            ]);
        }

        return back()->with('success', 'Berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $sparepart = $cart->sparepart;

        if ($request->jumlah > $sparepart->stok) {
            return back()->with('error', 'Jumlah melebihi stok tersedia!');
        }

        if ($request->jumlah < 1) {
            return back()->with('error', 'Jumlah minimal 1!');
        }

        $cart->update(['jumlah' => $request->jumlah]);
        return back()->with('success', 'Keranjang berhasil diupdate!');
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return back()->with('success', 'Item berhasil dihapus dari keranjang!');
    }

    public function checkout()
    {
        $carts = Cart::with('sparepart')->where('user_id', Auth::id())->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang masih kosong!');
        }

        foreach ($carts as $cart) {
            $sparepart = $cart->sparepart;

            if ($sparepart->stok < $cart->jumlah) {
                return back()->with('error', "Stok {$sparepart->nama_sparepart} tidak mencukupi!");
            }

            $sparepart->stok -= $cart->jumlah;
            $sparepart->save();
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect('/user')->with('success', 'Checkout berhasil! Terima kasih sudah berbelanja.');
    }
}
