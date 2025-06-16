<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        // Ini dia yang kamu maksud
        $query = Barang::with(['user', 'userPengklaim']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('namaBarang', 'like', '%' . $search . '%')
                ->orWhere('lokasiNemu', 'like', '%' . $search . '%')
                ->orWhere('kategoriBarang', 'like', '%' . $search . '%')
                ->orWhere('keterangan', 'like', '%' . $search . '%');
            });
        }

        // Filter status (lost/found)
        if ($request->filled('status')) {
            $query->where('statusKlaim', $request->status);
        }
        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategoriBarang', $request->kategori);
        }

        // Ambil data akhir
        $laporan = $query->latest()->get();

        return view('dashboardAdmin', compact('user', 'laporan'));
    }

    public function destroy($id)
    {
        $laporan = Barang::findOrFail($id);
        $laporan->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Laporan berhasil dihapus.');
    }
}
