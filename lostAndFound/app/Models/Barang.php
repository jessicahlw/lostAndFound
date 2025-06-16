<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategoriBarang',
        'namaBarang',
        'lokasiNemu',
        'detailLokasi',
        'fileFoto',
        'keterangan',
        'user_id',
        'status',
        'statusKlaim',
        'id_pengklaim',
        'foto_klaim',
        'keterangan_klaim',
        'tanggal_klaim', 
        'pesan_klaim', 
        'is_notified'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    
    }

    public function userPengklaim()
    {
        return $this->belongsTo(User::class, 'id_pengklaim');
    }

    public function isKlaimed()
{
    return $this->statusKlaim === 'Diterima' && !is_null($this->user_pengklaim_id);
}


public function hasUnreadNotification()
{
    return $this->isKlaimed() && !$this->is_notified;

}
}
