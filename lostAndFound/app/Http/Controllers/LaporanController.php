<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function form()
    {
        $kategoriBarang = [
            'Elektronik',
            'Buku',
            'Pecah Belah',
            'Obat-obatan',
            'Pakaian',
            'Lainnya'
        ];

        $lokasi = [
            'Lantai 1' => ['Kelas 101', 'Kelas 102', 'Lorong 1'],
            'Lantai 2' => ['Kelas 201', 'Kelas 202', 'Lorong 2'],
            'Lantai 3' => ['Aula', 'Toilet Umum']
        ];

        return view('formLaporan');
    }

    public function proses(Request $request)
    {
        $this->validate($request, [
            'kategoriBarang' => 'required',
            'namaBarang' => 'required',
            'lokasiNemu' => 'required',
            'detailLokasi' => 'nullable|string', 
            'keterangan' => 'nullable|string',
            'fileFoto' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $file = $request->file('fileFoto');
        $nama_file = time() . '_' . $file->getClientOriginalName();
        $tujuanUpload = 'data_file';
        $file->move(public_path($tujuanUpload), $nama_file);

        Barang::create([
            'user_id' => Auth::id(),
            'kategoriBarang' => $request->kategoriBarang,
            'namaBarang' => $request->namaBarang,
            'lokasiNemu' => $request->lokasiNemu,
            'detailLokasi' => $request->detailLokasi, 
            'keterangan' => $request->keterangan,
            'fileFoto' => $nama_file,
        ]);
        
        return back()->with('success', 'Laporan Berhasil Diupload dan Disimpan!');
    }

    // ✅ FIXED: Method pusatLaporan yang benar
    public function detail($id)
    {
        $barang = Barang::with('user')->findOrFail($id);
        return view('barang.detail ', compact('barang'));
    }

    public function klaim($id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->statusKlaim === 'sudah') {
            return back()->with('error', 'Barang ini sudah diklaim.');
        }

        $barang->statusKlaim = 'sudah';
        $barang->user_klaim_id = Auth::id();
        $barang->save();

        return back()->with('success', 'Barang berhasil diklaim.');
    }
    public function destroy($id)
    {
        try {
            // ✅ Gunakan model Barang, bukan Laporan
            $laporan = Barang::findOrFail($id);
            
            // Hapus file foto jika ada
            if ($laporan->fileFoto && file_exists(public_path('data_file/' . $laporan->fileFoto))) {
                unlink(public_path('data_file/' . $laporan->fileFoto));
            }
            
            $laporan->delete();
            
            return redirect()->route('admin.dashboard')->with('success', 'Laporan berhasil dihapus.');
            
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Gagal menghapus laporan: ' . $e->getMessage());
        }
    }
    public function formKlaim($id)
    {
        $barang = \App\Models\Barang::findOrFail($id);
        return view('barang.formKlaim', compact('barang'));
    }


}