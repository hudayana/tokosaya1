<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = ['user_id', 'nama_penerima', 'no_telepon', 'alamat', 'metode_pembayaran', 'total_harga', 'status'];

    public function details()
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}