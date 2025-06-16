<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Tampilkan dashboard user
    public function index()
    {
        $user = Auth::user();
        

        // Ambil laporan user + user pengklaim
        $laporan = Barang::with(['user', 'userPengklaim'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // Filter notifikasi berdasarkan status klaim yang "Diterima" dan belum dinotifikasi
        $laporanBaru = $laporan->filter(function ($item) {
            return $item->statusKlaim === 'Diterima' && !$item->is_notified;
        });

        return view('dashboard', compact('user', 'laporan', 'laporanBaru'));
    }


    // Method untuk tandai notifikasi sudah dibaca
    public function markAsRead($id)
    {
        $barang = Barang::where('id', $id)
            ->first();
        
        if ($barang) {
            $barang->update(['is_notified' => true]);
        }
        
        return response()->json(['success' => true]);
    }

    
    // Hapus barang milik user
    public function destroy($id)
    {
        $user = Auth::user();
        $barang = Barang::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $barang->delete();

        return redirect()->route('dashboard.user')->with('success', 'Barang berhasil dihapus.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $user = Auth::user();
        $barang = Barang::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        return view('edit', compact('barang'));
    }

    // Simpan hasil edit barang
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $barang = Barang::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'kategoriBarang' => 'required|string|max:255',
            'namaBarang' => 'required|string|max:255',
            'lokasiNemu' => 'required|string|max:255',
            'detailLokasi' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'fileFoto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $barang->kategoriBarang = $request->kategoriBarang;
        $barang->namaBarang = $request->namaBarang;
        $barang->lokasiNemu = $request->lokasiNemu;
        $barang->detailLokasi = $request->detailLokasi;
        $barang->keterangan = $request->keterangan;

        if ($request->hasFile('fileFoto')) {
            $file = $request->file('fileFoto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('data_file'), $nama_file);
            $barang->fileFoto = $nama_file;
        }

        $barang->save();
        session()->flash('barang_terakhir_diedit', $barang->id);
        return redirect()->route('dashboard.user')->with('success', 'Barang berhasil diperbarui.');
    }

    public function getKlaimDetail($id)
    {
        $barang = Barang::with(['user', 'userPengklaim'])->find($id);

        if (!$barang) {
            return response()->json(['error' => 'Data klaim tidak ditemukan'], 404);
        }

        return response()->json($barang);
    }

    public function klaim(Request $request, $id)
    {
            $barang = Barang::findOrFail($id);
            $barang->statusKlaim = 'Diajukan';
            $barang->user_id_pengklaim = Auth::id(); // misal kamu pakai ini
            $barang->save();
            return redirect()->back()->with('success', 'Barang berhasil diklaim.');
    }
}
