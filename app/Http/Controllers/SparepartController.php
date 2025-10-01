<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SparepartController extends Controller
{
    public function index()
    {
        $spareparts = Sparepart::latest()->get();
        return view('admin.sparepart.index', compact('spareparts'));
    }

    public function create()
    {
        return view('admin.sparepart.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sparepart' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/spareparts'), $filename);
            $data['gambar'] = $filename;
        }

        Sparepart::create($data);

        return redirect('/sparepart')->with('success', 'Sparepart berhasil ditambahkan!');
    }

    public function show(Sparepart $sparepart)
    {
        return view('admin.sparepart.show', compact('sparepart'));
    }

    public function edit(Sparepart $sparepart)
    {
        return view('admin.sparepart.edit', compact('sparepart'));
    }

    public function update(Request $request, Sparepart $sparepart)
    {
        $request->validate([
            'nama_sparepart' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($sparepart->gambar && file_exists(public_path('uploads/spareparts/' . $sparepart->gambar))) {
                unlink(public_path('uploads/spareparts/' . $sparepart->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/spareparts'), $filename);
            $data['gambar'] = $filename;
        }

        $sparepart->update($data);

        return redirect('/sparepart')->with('success', 'Sparepart berhasil diupdate!');
    }

    public function destroy(Sparepart $sparepart)
    {
        if ($sparepart->gambar && file_exists(public_path('uploads/spareparts/' . $sparepart->gambar))) {
            unlink(public_path('uploads/spareparts/' . $sparepart->gambar));
        }

        $sparepart->delete();

        return redirect('/sparepart')->with('success', 'Sparepart berhasil dihapus!');
    }
}
