<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'sparepart_id', 'jumlah', 'total'];

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
