<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $table = 'claims'; // sesuaikan kalau nama tabelnya bukan 'claims'

    protected $fillable = [
        'barang_id',
        'user_id',
        'alasan',
        'status',
    ];

    // Relasi ke user yang mengklaim
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke barang yang diklaim
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
