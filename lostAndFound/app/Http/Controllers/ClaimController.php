<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Claim;

class ClaimController extends Controller
{
    // Menampilkan form klaim barang
    public function formKlaim($id)
    {
        $barang = Barang::findOrFail($id);

        // Kalau barang udah diklaim, user gak boleh klaim lagi
        if ($barang->statusKlaim === 'sudah') {
            return redirect()->back()->with('error', 'Barang ini sudah diklaim oleh orang lain.');
        }

        return view('barang.formKlaim', compact('barang'));
    }

    // Menangani proses klaim barang
    public function claim(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        // Validasi input
        $request->validate([
            'keterangan' => 'nullable|string|max:255',
            'fotoKlaim' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Cegah double klaim
        if ($barang->statusKlaim === 'sudah') {
            return redirect()->back()->with('error', 'Barang ini sudah diklaim.');
        }

        // Simpan foto klaim ke storage
        $file = $request->file('fotoKlaim');
        $nama_file = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('data_file/klaim'), $nama_file);

        // Simpan ke tabel `claims`
        $klaim = Claim::create([
            'barang_id' => $barang->id,
            'user_id' => Auth::id(),
        ]);

        // Update data barang
        $barang->update([
            'statusKlaim' => 'sudah',
            'id_pengklaim' => Auth::id(), // make sure kolom ini ada
            'keterangan_klaim' => strip_tags($request->keterangan),
            'foto_klaim' => $nama_file,
        ]);

        return redirect()->route('laporan.detail', $barang->id)
            ->with('success', 'Barang berhasil diklaim!');
    }


    public function prosesKlaim(Request $request, $id)
    {
        // 1. Dapatkan user yang sedang login
        $user = Auth::user();

        // 2. Cari barang berdasarkan ID
        $barang = Barang::findOrFail($id);

        // 3. Validasi: pastikan barang belum diklaim dan bukan milik sendiri
        if ($barang->statusKlaim === 'belum' && $barang->user_id != $user->id) {
            
            // 4. Update status dan catat ID pengklaim
            $barang->statusKlaim = 'sudah';
            $barang->user_pengklaim_id = $user->id; // Pastikan ada kolom ini di tabel 'barangs'
            $barang->save();

            // 5. Kembalikan ke halaman detail dengan pesan sukses
            return redirect()->route('laporan.detail', $barang->id)->with('success', 'Barang telah berhasil Anda klaim!');
        }

        // Jika gagal, kembalikan dengan pesan error
        return redirect()->route('laporan.detail', $barang->id)->with('error', 'Gagal mengklaim barang ini karena sudah diklaim atau ini adalah laporan Anda sendiri.');
    }


    public function showKlaim($id)
    {
        $klaim = Claim::with(['barang', 'pengklaim'])->findOrFail($id);

        // Cek apakah yang mengakses adalah pelapor
        if ($klaim->barang->user_id !== Auth::id()) {
            abort(403);
        }

        return view('klaim.detail', compact('klaim'));
    }

}
