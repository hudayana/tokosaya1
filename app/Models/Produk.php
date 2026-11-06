<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // 1. Tambahkan 'kategori_id' di sini
    protected $fillable = ['nama', 'harga', 'deskripsi', 'gambar', 'kategori_id'];

    // 2. Tambahkan fungsi relasi ini
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}