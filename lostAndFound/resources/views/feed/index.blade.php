<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pusat Laporan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f3f3f3;
            font-family: 'Poppins', sans-serif; /* Menggunakan Poppins untuk tampilan modern */
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: #333; /* Warna teks dasar yang lebih lembut */
        }

        h1 {
            text-align: center;
            color: #800000; /* Maroon gelap yang elegan */
            margin: 50px 0 40px; /* Jarak atas dan bawah */
            font-size: 2.8em; /* Ukuran font lebih besar untuk judul utama */
            font-weight: 700; /* Lebih tebal */
            letter-spacing: -0.5px; /* Sedikit spasi antar huruf */
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1); /* Sedikit bayangan pada teks */
        }

        /* === SEARCH BOX UTAMA === */
        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px auto;
            padding: 0 20px;
            width: 100%;
        }

        .search-box {
            background: linear-gradient(to right, #800000, #4B0000); /* Gradient maroon yang menarik */
            padding: 30px; /* Padding lebih besar */
            border-radius: 20px; /* Border radius lebih besar untuk tampilan lembut */
            width: 100%;
            max-width: 700px; /* Lebar maksimal lebih besar */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4); /* Bayangan lebih dalam dan dramatis */
            text-align: center;
            position: relative; /* Untuk efek pseudo-element */
            overflow: hidden; /* Pastikan konten tidak keluar dari radius */
        }

        .search-box::before { /* Efek overlay atau dekorasi di belakang */
            content: '';
            position: absolute;
            top: -50px;
            left: -50px;
            width: 150%;
            height: 150%;
            background: radial-gradient(circle at top left, rgba(255,255,255,0.05), transparent 70%);
            transform: rotate(20deg);
            pointer-events: none;
            z-index: 0;
        }

        .search-title {
            color: white;
            font-size: 24px; /* Ukuran font lebih besar */
            font-weight: 700; /* Sangat tebal */
            margin-bottom: 25px; /* Jarak bawah lebih */
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3); /* Bayangan teks lebih kuat */
            position: relative;
            z-index: 1;
        }

        .search-form {
            display: flex;
            gap: 15px; /* Jarak antar elemen form */
            align-items: center;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .search-input {
            flex: 1;
            padding: 16px 20px; /* Padding lebih nyaman */
            border: none;
            border-radius: 10px; /* Border radius lebih lembut */
            font-size: 17px; /* Ukuran font lebih besar */
            outline: none;
            box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.1); /* Bayangan internal untuk kedalaman */
            transition: all 0.3s ease; /* Transisi halus */
            color: #333;
        }

        .search-input::placeholder {
            color: #999;
        }

        .search-input:focus {
            box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.2), 0 0 0 3px rgba(128,0,0,0.3); /* Efek fokus yang lebih jelas */
        }

        .search-button {
            padding: 16px 30px; /* Padding lebih besar */
            border: none;
            border-radius: 10px; /* Border radius lebih lembut */
            background: white;
            color: #4B0000; /* Warna teks maroon tua */
            font-weight: 700; /* Lebih tebal */
            font-size: 17px; /* Ukuran font lebih besar */
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Bayangan lebih dalam */
            transition: all 0.3s ease; /* Transisi halus */
            text-transform: uppercase; /* Huruf kapital */
            letter-spacing: 0.5px;
        }

        .search-button:hover {
            background-color: #e0e0e0; /* Warna hover sedikit lebih gelap */
            transform: translateY(-3px); /* Efek angkat lebih tinggi */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3); /* Bayangan lebih intens */
        }

        /* === CARD STYLE === */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); /* Ukuran kartu sedikit lebih besar */
            gap: 30px; /* Jarak antar kartu lebih besar */
            padding: 0 40px 60px; /* Padding lebih nyaman */
            max-width: 1200px; /* Batasan lebar untuk grid */
            margin: 0 auto; /* Tengah grid */
        }

        .card {
            background: white;
            border-radius: 18px; /* Border radius lebih besar */
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Bayangan lebih jelas */
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e0e0e0; /* Border halus */
        }

        .card:hover {
            transform: translateY(-5px); /* Efek angkat lebih signifikan */
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25); /* Bayangan lebih kuat */
        }

        .card img {
            height: 220px; /* Tinggi gambar lebih besar */
            width: 100%;
            object-fit: cover;
            border-bottom: 1px solid #f0f0f0; /* Border bawah gambar */
        }

        .card-body {
            padding: 20px; /* Padding lebih besar */
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .card-body h3 {
            margin: 0 0 12px; /* Jarak bawah lebih */
            font-size: 20px; /* Ukuran font lebih besar */
            font-weight: 600; /* Lebih tebal */
            color: #333;
            line-height: 1.3;
        }

        .card-body p {
            font-size: 15px; /* Ukuran font sedikit lebih besar */
            color: #555; /* Warna teks lebih gelap */
            margin: 6px 0; /* Jarak antar paragraf */
        }

        .status {
            /* Atur ulang gaya status jika diperlukan, tapi badge akan menggantikan visual utama */
            margin-top: 10px; /* Jarak atas badge */
            margin-bottom: 8px; /* Memberi sedikit ruang di bawah badge */
        }

        /* Hapus atau sesuaikan jika tidak pakai dot lagi */
        .status span {
            display: none; /* Sembunyikan dot jika pakai badge */
        }

        /* --- Badge Styles --- */
        .status-badge {
            display: inline-flex; /* Menggunakan flexbox untuk alignment ikon/teks */
            align-items: center;
            padding: 6px 12px;
            border-radius: 20px; /* Bentuk pil/rounded */
            font-size: 13px; /* Ukuran font badge */
            font-weight: 600; /* Tebal */
            text-transform: uppercase; /* Huruf kapital */
            letter-spacing: 0.5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1); /* Sedikit bayangan pada badge */
            white-space: nowrap; /* Mencegah badge terpotong */
        }

        .status-claimed {
            background-color: #e6ffe6; /* Latar belakang hijau sangat muda */
            color: #28a745; /* Warna teks hijau cerah */
            border: 1px solid #28a745; /* Border hijau */
        }

        .status-available {
            background-color: #ffe6e6; /* Latar belakang merah sangat muda */
            color: #dc3545; /* Warna teks merah cerah */
            border: 1px solid #dc3545; /* Border merah */
        }

        .reporter {
            font-size: 13px; /* Ukuran font sedikit lebih besar */
            color: #777; /* Warna abu-abu yang lebih lembut */
            font-style: italic;
            margin-top: auto; /* Dorong ke bawah */
            padding-top: 15px; /* Padding atas */
            border-top: 1px solid #f5f5f5; /* Garis pemisah halus */
        }

        .detail-link {
            margin-top: 20px; /* Jarak atas lebih */
            text-align: center;
        }

        .detail-link a {
            background: #800000; /* Maroon utama */
            color: white;
            padding: 12px 25px; /* Padding lebih besar */
            border-radius: 8px; /* Border radius lebih lembut */
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease, transform 0.2s ease;
            font-weight: 600; /* Lebih tebal */
            letter-spacing: 0.2px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.2); /* Bayangan pada tombol */
        }

        .detail-link a:hover {
            background-color: #660000; /* Maroon lebih gelap saat hover */
            transform: translateY(-2px); /* Efek angkat */
            box-shadow: 0 5px 12px rgba(0,0,0,0.3); /* Bayangan lebih intens */
        }

        .no-data {
            text-align: center;
            color: #888; /* Warna teks lebih lembut */
            margin-top: 70px; /* Jarak atas lebih */
            font-size: 1.2em; /* Ukuran font lebih besar */
            font-weight: 500;
            grid-column: 1 / -1; /* Pastikan di tengah grid */
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.2em;
                margin: 30px 0;
            }
            .search-box {
                padding: 20px;
                border-radius: 15px;
            }
            .search-title {
                font-size: 20px;
                margin-bottom: 20px;
            }
            .search-form {
                flex-direction: column;
                gap: 15px;
            }
            .search-input,
            .search-button {
                width: 100%;
                padding: 14px 18px;
                font-size: 15px;
            }
            .card-grid {
                grid-template-columns: 1fr;
                padding: 0 20px 40px;
                gap: 25px;
            }
            .card img {
                height: 180px;
            }
            .card-body {
                padding: 18px;
            }
            .card-body h3 {
                font-size: 18px;
            }
            .card-body p {
                font-size: 13.5px;
            }
            .status {
                /* Atur ulang gaya status jika diperlukan */
                margin-top: 8px; /* Lebih kecil di mobile */
            }
            .status-badge {
                font-size: 12px;
                padding: 5px 10px;
            }
            .detail-link a {
                padding: 10px 20px;
                font-size: 15px;
            }
            .no-data {
                font-size: 1em;
                margin-top: 40px;
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.8em;
                margin: 25px 0;
            }
            .search-box {
                padding: 15px;
            }
            .search-title {
                font-size: 18px;
                margin-bottom: 15px;
            }
            .search-input,
            .search-button {
                padding: 12px 15px;
                font-size: 14px;
            }
            .card-grid {
                padding: 0 15px 30px;
                gap: 20px;
            }
            .card img {
                height: 150px;
            }
            .card-body {
                padding: 15px;
            }
            .card-body h3 {
                font-size: 17px;
            }
            .detail-link a {
                padding: 9px 18px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <h1>Pusat Laporan Barang Hilang & Ditemukan</h1>

    <div class="search-container">
        <div class="search-box">
            <div class="search-title">🔍 Cari Laporan Barang</div>
            <form method="GET" action="/feed" class="search-form">
                <input
                    type="text"
                    name="search"
                    class="search-input"
                    placeholder="Ketik nama barang, lokasi, atau kategori..."
                    value="{{ request('search') }}"
                >
                <button type="submit" class="search-button">CARI SEKARANG</button>
            </form>
        </div>
    </div>


    <div class="card-grid">
        @if(isset($laporanBarang) && count($laporanBarang) > 0)
            @foreach ($laporanBarang as $item)
                <div class="card">
                    @if($item->fileFoto)
                        @if(str_contains($item->fileFoto, '/'))
                            <img src="{{ asset('storage/' . $item->fileFoto) }}" alt="Foto Barang"
                            onerror="this.src='https://via.placeholder.com/300x180?text=No+Image'">
                        @else
                            <img src="{{ asset('data_file/' . $item->fileFoto) }}" alt="Foto Barang"
                            onerror="this.src='https://via.placeholder.com/300x180?text=No+Image'">
                        @endif
                    @else
                        <img src="https://via.placeholder.com/300x180?text=No+Image" alt="No Image">
                    @endif
                    <div class="card-body">
                        <h3>{{ $item->namaBarang }}</h3>
                        <p><strong>Kategori:</strong> {{ $item->kategoriBarang }}</p>
                        <p><strong>Lokasi:</strong> {{ $item->lokasiNemu }}</p>

                        {{-- BAGIAN INI YANG DIUBAH UNTUK MENGGUNAKAN BADGE --}}
                        <div class="status">
                            @if($item->statusKlaim == 'sudah')
                                <div class="status-badge status-claimed">✅ Telah Diklaim</div>
                            @elseif($item->statusKlaim == 'belum')
                                <div class="status-badge status-available">📢 Belum Diklaim</div>
                            @else
                                <div class="status-badge status-available">❓ Status Tidak Diketahui</div>
                            @endif
                        </div>
                        {{-- AKHIR BAGIAN YANG DIUBAH --}}

                        <p class="reporter">Dilaporkan oleh: {{ $item->user->name ?? 'Anonim' }}</p>

                        <div class="detail-link">
                            <a href="/laporan/{{ $item->id }}">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="no-data">Tidak ada laporan ditemukan.</div>
        @endif
    </div>

</body>
</html>