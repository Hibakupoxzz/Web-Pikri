@extends('layout')

@section('content')
<h3>Edit Sparepart</h3>
<form method="POST" action="{{ route('sparepart.update',$sparepart->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ $sparepart->nama }}" required>
    </div>
    <div class="mb-3">
        <label>Kategori</label>
        <input type="text" name="kategori" class="form-control" value="{{ $sparepart->kategori }}" required>
    </div>
    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ $sparepart->stok }}" required>
    </div>
    <div class="mb-3">
        <label>Harga</label>
        <input type="number" step="0.01" name="harga" class="form-control" value="{{ $sparepart->harga }}" required>
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
