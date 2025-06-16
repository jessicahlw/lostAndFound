<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Pengajuan Klaim</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="max-w-3xl mx-auto my-10 bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Detail Pengajuan Klaim</h1>

        <div class="space-y-4 text-gray-700">

            <p><strong>Nama Barang:</strong> {{ $klaim->barang->nama_barang }}</p>
            <p><strong>Lokasi Ditemukan:</strong> {{ $klaim->barang->lokasi_nemu }}</p>

            <hr class="my-4">

            <p><strong>Nama Pengklaim:</strong> {{ $klaim->pengklaim->name }}</p>
            <p><strong>Email Pengklaim:</strong> {{ $klaim->pengklaim->email }}</p>

            @if($klaim->deskripsi)
                <p><strong>Deskripsi Klaim:</strong> {{ $klaim->deskripsi }}</p>
            @endif

            @if($klaim->bukti_klaim)
                <div>
                    <strong>Bukti Klaim:</strong>
                    <img src="{{ asset('data_file/' . $klaim->bukti_klaim) }}" alt="Bukti Klaim" class="mt-2 rounded-lg shadow-md max-w-xs">
                </div>
            @endif

            <p><strong>Status Klaim:</strong>
                @if ($klaim->status == 'pending')
                    <span class="text-yellow-500 font-semibold">Menunggu Konfirmasi</span>
                @elseif ($klaim->status == 'diterima')
                    <span class="text-green-600 font-semibold">Diterima</span>
                @elseif ($klaim->status == 'ditolak')
                    <span class="text-red-600 font-semibold">Ditolak</span>
                @endif
            </p>
        </div>

        {{-- Tombol Terima/Tolak jika klaim masih pending --}}
        @if ($klaim->status == 'pending')
            <div class="mt-8 flex gap-4 justify-center">
                <form action="{{ route('klaim.terima', $klaim->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700 transition">
                        Terima Klaim
                    </button>
                </form>

                <form action="{{ route('klaim.tolak', $klaim->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white font-bold py-2 px-4 rounded hover:bg-red-700 transition">
                        Tolak Klaim
                    </button>
                </form>
            </div>
        @endif

        <!-- Tombol Kembali -->
        <div class="mt-6 text-center">
            <a href="{{ route('notifikasi') }}" class="inline-block bg-gray-700 text-white px-6 py-2 rounded-lg hover:bg-gray-800 transition duration-300">
                Kembali ke Notifikasi
            </a>
        </div>
    </div>

</body>
</html>
