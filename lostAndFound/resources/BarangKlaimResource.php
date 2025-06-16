<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BarangKlaimResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_barang' => $this->namaBarang,
            'kategori' => $this->kategoriBarang,
            'lokasi_nemu' => $this->lokasiNemu,
            'status_klaim' => $this->statusKlaim,
            'penemu' => $this->user?->name,
            'pengklaim' => $this->userPengklaim?->name ?? null,
        ];
    }
}
