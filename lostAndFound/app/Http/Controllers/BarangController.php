<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::with('user');
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('namaBarang', 'like', '%' . $search . '%')
                  ->orWhere('lokasiNemu', 'like', '%' . $search . '%')
                  ->orWhere('kategoriBarang', 'like', '%' . $search . '%')
                  ->orWhere('keterangan', 'like', '%' . $search . '%');
            });
        }
        
        $laporanBarang = $query->latest()->get();

        return view('feed.index', compact('laporanBarang'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaBarang' => 'required|string|max:255',
            'kategoriBarang' => 'required|string|max:100',
            'lokasiNemu' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:1000',
            'fileFoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('fileFoto')) {
            $fotoPath = $request->file('fileFoto')->store('barang', 'public');
        }

        Barang::create([
            'namaBarang' => $request->namaBarang,
            'kategoriBarang' => $request->kategoriBarang,
            'lokasiNemu' => $request->lokasiNemu,
            'keterangan' => $request->keterangan,
            'fileFoto' => $fotoPath,
            'user_id' => Auth::id(),
            'statusKlaim' => 'Belum diterima',
        ]);

        return redirect()->back()->with('success', 'Barang berhasil disimpan!');
    }

    public function show($id)
    {
        $barang = Barang::with(['user', 'userPengklaim'])->findOrFail($id);
        return view('barang.detail', compact('barang'));
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'namaBarang' => 'required|string|max:255',
            'kategoriBarang' => 'required|string|max:100',
            'lokasiNemu' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:1000',
            'fileFoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('fileFoto')) {
            $file = $request->file('fileFoto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('data_file'), $nama_file);
            $barang->fileFoto = $nama_file;
        }

        $barang->namaBarang = $request->namaBarang;
        $barang->kategoriBarang = $request->kategoriBarang;
        $barang->lokasiNemu = $request->lokasiNemu;
        $barang->keterangan = $request->keterangan;
        $barang->save();

        return redirect()->route('barang.edit', $barang->id)->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->fileFoto) {
            Storage::disk('public')->delete($barang->fileFoto);
        }

        $barang->delete();
        return redirect()->back()->with('success', 'Barang berhasil dihapus!');
    }

    public function claimBarang(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        // Validasi input jika diperlukan
        $request->validate([
            'pesan_klaim' => 'required|string|max:1000', // Misalnya, jika Anda ingin menambahkan pesan klaim
        ]);
        // Update status klaim
        $barang->update([
            'statusKlaim' => 'Diterima',
            'user_pengklaim_id' => Auth::id(),
            'tanggal_klaim' => now(),
            'pesan_klaim' => $request->pesan_klaim, // Pastikan ini ada di form klaim
            'is_notified' => false
        ]);
        return redirect()->route('feed.index')->with('success', 'Barang berhasil diklaim!');
    }
    
    public function markRead($id)
    {
        $laporan = Barang::findOrFail($id);

        if ($laporan->user_id == Auth::id()) {
            $laporan->is_notified = true;
            $laporan->save();
        }

        return back()->with('success');
    }

    // ✅ Tambahan untuk AJAX klaim
    public function getClaims($id)
    {
        $barang = Barang::with('userPengklaim')->findOrFail($id);

        if ($barang->userPengklaim) {
            $claim = [
                'name' => $barang->userPengklaim->name,
                'email' => $barang->userPengklaim->email,
                'phone' => $barang->userPengklaim->phone ?? '-',
                'description' => $barang->keterangan_klaim ?? '-',
                'created_at' => $barang->tanggal_klaim ? $barang->tanggal_klaim->format('d/m/Y H:i') : '-',
            ];

            return response()->json(['claims' => [$claim]]);
        }

        return response()->json(['claims' => []]);
    }
    
}
