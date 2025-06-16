<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Optional: Add custom styles if Tailwind CSS classes aren't enough for specific details */
        /* For example, if you want a custom shadow for the image or more specific text styles */
        .image-shadow {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .claimed-by-text {
            /* Example: to ensure this specific text always has a certain color or weight */
            color: #4a5568; /* A bit darker gray */
            font-weight: 500;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <div class="max-w-3xl mx-auto my-10 bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Detail Laporan Barang</h1>

        <div class="flex flex-col md:flex-row gap-8">
            <div class="md:w-1/2 flex justify-center items-start">
                @if($barang->fileFoto)
                    <img src="{{ asset('data_file/' . $barang->fileFoto) }}" alt="Foto {{ $barang->nama_barang }}" class="rounded-lg shadow-md max-h-96 object-cover w-full image-shadow">
                    {{-- Added w-full for better responsiveness and custom class for deeper shadow --}}
                @else
                    <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500">Tidak ada gambar</span>
                    </div>
                @endif
            </div>

            <div class="md:w-1/2">
                <h2 class="text-2xl font-semibold text-gray-900">{{ $barang->namaBarang }}</h2>

                <div class="mt-4 space-y-2 text-gray-700">
                    <p><strong>Kategori:</strong> {{ $barang->kategoriBarang }}</p>
                    <p><strong>Lokasi:</strong> {{ $barang->lokasiNemu }}</p>
                    
                    @if ($barang->detailLokasi)
                        <p><strong>Detail Lokasi:</strong> {{ $barang->detailLokasi }}</p>
                    @endif

                    @if ($barang->keterangan)
                        <p><strong>Keterangan:</strong> {{ $barang->keterangan }}</p>
                    @endif

                    {{-- Menggunakan null coalescing operator untuk relasi user --}}
                    <p><strong>Pelapor:</strong> {{ $barang->user->name ?? 'Tidak diketahui (Pelapor dihapus)' }}</p>
                </div>

                <div class="mt-6 border-t pt-4">
                    @if($barang->statusKlaim === 'sudah')
                        <p class="text-lg font-bold text-green-600">Status: Sudah Diklaim</p>
                        {{-- Menggunakan null coalescing operator untuk relasi userPengklaim --}}
                        <p class="text-md text-gray-800 claimed-by-text">Diklaim oleh: <strong>{{ $barang->userPengklaim->name ?? 'Informasi tidak tersedia (Pengklaim dihapus)' }}</strong></p>
                    @else
                        <p class="text-lg font-bold text-red-600">Status: Belum Diklaim</p>

                        {{-- Tombol klaim untuk semua user yang login --}}
                        @auth {{-- Pastikan user login --}}
                            {{-- Cek apakah user yang login BUKAN pelapor barang --}}
                            @if (auth()->user()->id !== $barang->user_id)
                                <form action="{{ route('barang.formKlaim', $barang->id) }}" method="GET" class="mt-4">
                                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
                                        Ajukan Klaim Barang
                                    </button>
                                </form>
                            @else
                                {{-- Jika user yang login ADALAH pelapor barang --}}
                                <p class="text-sm text-gray-500 mt-2 italic">Kamu adalah pelapor barang ini.</p>
                            @endif
                        @else {{-- Jika user BELUM login --}}
                            <p class="text-gray-600 mt-4 text-center">Silakan <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">login</a> untuk mengajukan klaim.</p>
                        @endauth
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('feed.index') }}" class="inline-block bg-gray-700 text-white px-6 py-2 rounded-lg hover:bg-gray-800 transition duration-300">Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>