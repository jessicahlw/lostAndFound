<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class PusatLaporanController extends Controller
{
    /**
     * Menampilkan pusat laporan barang (dengan fitur pencarian).
     */
    public function index(Request $request)
    {
        $query = Barang::with('user');

        // Jika ada keyword pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('namaBarang', 'like', '%' . $request->search . '%')
                  ->orWhere('lokasiNemu', 'like', '%' . $request->search . '%')
                  ->orWhere('kategoriBarang', 'like', '%' . $request->search . '%');
        }

        $laporanBarang = $query->latest()->get();

        // View-nya harus: resources/views/laporan/pusatLaporan.blade.php
        return view('laporan.pusatLaporan', compact('laporanBarang'));
    }

    /**
     * Menampilkan detail laporan barang tertentu berdasarkan ID.
     */
    public function show($id)
    {
        $barang = Barang::with('user', 'userPengklaim')->findOrFail($id);

        // View-nya harus: resources/views/laporan/detailLaporan.blade.php
        return view('laporan.detailLaporan', compact('barang'));
    }
}
