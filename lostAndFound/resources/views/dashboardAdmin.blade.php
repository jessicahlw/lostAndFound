<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            line-height: 1.6;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, #8B0000, #A52A2A);
            color: white;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.05);
            pointer-events: none;
        }

        .sidebar h2 {
            font-size: 26px;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .user-info {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .user-info p {
            margin: 8px 0;
            font-size: 15px;
        }

        .user-info strong {
            color: #FFE4B5;
        }

        .logout-btn {
            background: linear-gradient(45deg, #fff, #f0f0f0);
            color: #8B0000;
            border: none;
            padding: 14px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            margin-top: auto;
            transition: all 0.3s ease;
            font-size: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .logout-btn:hover {
            background: linear-gradient(45deg, #f0f0f0, #e0e0e0);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .main {
            flex: 1;
            padding: 40px;
            background: #f8f9fa;
        }

        h1 {
            color: #8B0000;
            margin-bottom: 10px;
            font-size: 32px;
            font-weight: 700;
        }

        .welcome-text {
            color: #6c757d;
            margin-bottom: 30px;
            font-size: 18px;
            font-weight: 400;
        }

        .search-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            border: 1px solid #e9ecef;
        }

        .search-form {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto auto;
            gap: 15px;
            align-items: center;
        }

        .search-input, .search-select {
            padding: 14px 18px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fff;
        }

        .search-input:focus, .search-select:focus {
            outline: none;
            border-color: #8B0000;
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
        }

        .search-select {
            cursor: pointer;
        }

        .search-btn, .reset-btn {
            background: linear-gradient(45deg, #8B0000, #A52A2A);
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 15px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(139, 0, 0, 0.3);
        }

        .search-btn:hover {
            background: linear-gradient(45deg, #A52A2A, #8B0000);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 0, 0, 0.4);
        }

        .reset-btn {
            background: linear-gradient(45deg, #6c757d, #5a6268);
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        .reset-btn:hover {
            background: linear-gradient(45deg, #5a6268, #495057);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
        }

        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid #e9ecef;
        }

        .table-header {
            background: linear-gradient(135deg, #8B0000, #A52A2A);
            color: white;
            padding: 25px;
            font-size: 22px;
            font-weight: 600;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 16px 20px;
            text-align: left;
            vertical-align: middle;
            border-bottom: 1px solid #f1f3f4;
        }

        th {
            background: #f8f9fa;
            color: #8B0000;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        tr {
            transition: all 0.3s ease;
        }

        tr:hover {
            background: #f8f9fa;
            transform: translateY(-1px);
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .status-lost {
            background: linear-gradient(45deg, #dc3545, #c82333);
            color: white;
            box-shadow: 0 2px 10px rgba(220, 53, 69, 0.3);
        }

        .status-found {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            box-shadow: 0 2px 10px rgba(40, 167, 69, 0.3);
        }

        .photo-cell img {
            width: 80px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid #e9ecef;
            transition: transform 0.3s ease;
        }

        .photo-cell img:hover {
            transform: scale(1.1);
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: stretch;
        }

        .view-claims-btn, .delete-btn {
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .view-claims-btn {
            background: linear-gradient(45deg, #17a2b8, #138496);
            color: white;
            box-shadow: 0 2px 10px rgba(23, 162, 184, 0.3);
        }

        .view-claims-btn:hover {
            background: linear-gradient(45deg, #138496, #117a8b);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(23, 162, 184, 0.4);
        }

        .delete-btn {
            background: linear-gradient(45deg, #dc3545, #c82333);
            color: white;
            box-shadow: 0 2px 10px rgba(220, 53, 69, 0.3);
        }

        .delete-btn:hover {
            background: linear-gradient(45deg, #c82333, #bd2130);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
        }

        .claims-count {
            background: linear-gradient(45deg, #ffc107, #e0a800);
            color: #856404;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
            min-width: 20px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
        }

        .no-data {
            text-align: center;
            padding: 60px 40px;
            color: #6c757d;
            font-style: italic;
            font-size: 18px;
        }

        .whatsapp-link {
            color: #25D366;
            text-decoration: none;
            font-weight: 600;
            white-space: nowrap;
            transition: color 0.3s ease;
        }

        .whatsapp-link:hover {
            color: #128C7E;
            text-decoration: underline;
        }

        .text-success {
            color: #28a745;
            font-weight: 600;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            opacity: 0;
            transition: opacity 0.3s ease;
            /* Added for initial centering before animation */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            opacity: 1;
        }

        .modal-content {
            background: white;
            /* Removed margin: 5% auto; to let flexbox center it */
            border-radius: 20px;
            width: 90%;
            max-width: 900px;
            max-height: 85vh;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            transform: scale(0.7);
            transition: transform 0.3s ease;
        }

        .modal.show .modal-content {
            transform: scale(1);
        }

        .modal-header {
            background: linear-gradient(135deg, #8B0000, #A52A2A);
            color: white;
            padding: 25px 30px;
            font-size: 22px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .close {
            color: white;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 30px;
            flex-grow: 1;
            overflow-y: auto;
            background: #f8f9fa;
        }

        .claim-item {
            border: 1px solid #e9ecef;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .claim-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .claim-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .claim-name {
            font-weight: 700;
            color: #8B0000;
            font-size: 20px;
            margin-right: 15px;
        }

        .claim-date {
            color: #6c757d;
            font-size: 14px;
            font-weight: 500;
        }

        .claim-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .claim-info div {
            display: flex;
            flex-direction: column;
        }

        .claim-info label {
            font-weight: 600;
            font-size: 14px;
            color: #495057;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .claim-info span {
            font-size: 16px;
            word-wrap: break-word;
            color: #212529;
        }

        .claim-description {
            margin-top: 20px;
        }

        .claim-description label {
            font-weight: 600;
            font-size: 14px;
            color: #495057;
            display: block;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .claim-description p {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin: 0;
            font-size: 16px;
            line-height: 1.6;
            border-left: 4px solid #8B0000;
        }

        .contact-btn {
            background: linear-gradient(45deg, #25D366, #128C7E);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
        }

        .contact-btn:hover {
            background: linear-gradient(45deg, #128C7E, #075e54);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
        }

        .loading {
            text-align: center;
            padding: 60px;
            color: #6c757d;
            font-size: 18px;
        }

        .loading::after {
            content: '';
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #8B0000;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-left: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .search-form {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }

        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 20px;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }

            .sidebar h2 {
                margin-bottom: 0;
                font-size: 20px;
            }

            .user-info {
                padding: 15px;
                margin-bottom: 0;
                margin-right: 20px;
            }

            .user-info p {
                font-size: 14px;
                margin: 4px 0;
            }

            .logout-btn {
                width: auto;
                font-size: 14px;
                padding: 10px 15px;
                margin-top: 0;
            }

            .main {
                padding: 20px;
            }

            h1 {
                font-size: 26px;
            }

            .welcome-text {
                font-size: 16px;
            }

            .search-container {
                padding: 20px;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                font-size: 13px;
                min-width: 800px;
            }

            th, td {
                padding: 12px 15px;
            }

            .photo-cell img {
                width: 60px;
                height: 45px;
            }

            .action-buttons {
                flex-direction: row;
                gap: 5px;
                flex-wrap: wrap;
            }

            .view-claims-btn, .delete-btn {
                padding: 8px 12px;
                font-size: 12px;
                width: auto;
            }

            .modal-content {
                width: 95%;
                margin: 2% auto;
                max-height: 95vh;
            }

            .modal-header {
                font-size: 18px;
                padding: 20px;
            }

            .modal-body {
                padding: 20px;
            }

            .claim-item {
                padding: 20px;
            }

            .claim-name {
                font-size: 18px;
            }

            .claim-info {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <div>
                <h2>🎯 Admin Panel</h2>
                <div class="user-info">
                    <p><strong>Nama:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                </div>
            </div>
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">🚪 Logout</button>
            </form>
        </div>

        <div class="main">
            <h1>Dashboard Admin</h1>
            <p class="welcome-text">Selamat datang, {{ $user->name }} (Administrator)</p>

            <div class="search-container">
                <form method="GET" action="{{ route('admin.dashboard') }}" class="search-form">
                    <input type="text"
                           name="search"
                           class="search-input"
                           placeholder="🔍 Cari berdasarkan nama barang, kategori, atau lokasi..."
                           value="{{ request('search') }}">

                    <select name="status" class="search-select">
                        <option value="">📊 Semua Status</option>
                        <option value="belum" {{ request('status') == 'belum' ? 'selected' : '' }}>❌ Lost</option>
                        <option value="sudah" {{ request('status') == 'sudah' ? 'selected' : '' }}>✅ Found</option>
                    </select>

                    <select name="kategori" class="search-select">
                        <option value="">📁 Semua Kategori</option>
                        <option value="elektronik" {{ request('kategori') == 'elektronik' ? 'selected' : '' }}>📱 Elektronik</option>
                        <option value="pakaian" {{ request('kategori') == 'pakaian' ? 'selected' : '' }}>👔 Pakaian</option>
                        <option value="aksesoris" {{ request('kategori') == 'aksesoris' ? 'selected' : '' }}>💍 Aksesoris</option>
                        <option value="dokumen" {{ request('kategori') == 'dokumen' ? 'selected' : '' }}>📄 Dokumen</option>
                        <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>📦 Lainnya</option>
                    </select>

                    <button type="submit" class="search-btn">🔍 Cari</button>
                    <a href="{{ route('admin.dashboard') }}" class="reset-btn">🔄 Reset</a>
                </form>
            </div>

            <div class="table-container">
                <div class="table-header">
                    📋 Semua Laporan Barang ({{ $laporan->count() }} laporan)
                </div>

                @if($laporan->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>📝 Nama Barang</th>
                            <th>📂 Kategori</th>
                            <th>🏷️ Status</th>
                            <th>📍 Lokasi</th>
                            <th>📸 Foto</th>
                            <th>👤 Pelapor</th>
                            <th>🙋 Pengklaim</th>
                            <th>📞 No. Telepon</th>
                            <th>📅 Tanggal</th>
                            <th>⚙️ Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporan as $item)
                        <tr>
                            <td><strong>{{ $item->namaBarang }}</strong></td>
                            <td>{{ ucfirst($item->kategoriBarang) }}</td>
                            <td>
                                <span class="status-badge {{ $item->statusKlaim == 'belum' ? 'status-lost' : 'status-found' }}">
                                    {{ $item->statusKlaim == 'belum' ? 'Lost' : 'Found' }}
                                </span>
                            </td>
                            <td>{{ $item->lokasiNemu }}</td>
                            <td class="photo-cell">
                                <img src="{{ asset('data_file/'.$item->fileFoto) }}" alt="Foto barang" onerror="this.onerror=null;this.src='https://placehold.co/80x60/cccccc/333333?text=No+Image';">
                            </td>
                            <td>{{ $item->user->name ?? 'Tidak diketahui' }}</td>
                            <td>
                                @if($item->userPengklaim)
                                    <span class="text-success">{{ $item->userPengklaim->name }}</span>
                                @else
                                    <em>Belum diklaim</em>
                                @endif
                            </td>
                            <td>
                                @if($item->user && $item->user->phone)
                                    @php
                                        $phoneNumber = preg_replace('/[^0-9]/', '', $item->user->phone);
                                        if (substr($phoneNumber, 0, 1) === '0') {
                                            $phoneNumber = '62' . substr($phoneNumber, 1);
                                        } elseif (substr($phoneNumber, 0, 2) !== '62' && substr($phoneNumber, 0, 3) !== '+62') {
                                            $phoneNumber = '62' . $phoneNumber;
                                        }
                                        $whatsappUrlPelapor = "https://wa.me/{$phoneNumber}?text=" . urlencode("Salam HEI! Kami dari Tim LostandFound Telkom University telah menerima laporan barang *{$item->namaBarang}* Anda. Terima Kasih atas Kepercayaan Anda dalam menggunakan Web LostandFound");
                                    @endphp
                                    <a href="{{ $whatsappUrlPelapor }}" target="_blank" class="whatsapp-link" title="Hubungi via WhatsApp">
                                        {{ $item->user->phone }}
                                    </a>
                                @else
                                    <span style="color: #999; font-style: italic;">Tidak tersedia</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td class="action-buttons">
                                <button onclick="showClaims('{{ $item->id }}', '{{ $item->namaBarang }}')" class="view-claims-btn">
                                    👀 Lihat Klaim
                                    @if(isset($item->claims) && $item->claims->count() > 0)
                                        <span class="claims-count">{{ $item->claims->count() }}</span>
                                    @endif
                                </button>
                                <form action="{{ route('admin.laporan.delete', $item->id) }}" method="POST" onsubmit="return confirmDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="no-data">
                    Tidak ada laporan yang ditemukan.
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal untuk Detail Klaim -->
    <div id="claimsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span>📋 Detail Klaim Barang</span>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body" id="claimsContent">
                <!-- Content akan diisi secara dinamis -->
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            // Menggunakan event.preventDefault() untuk menghentikan submit form secara default
            // dan menangani penghapusan via fetch API jika perlu, tapi untuk Laravel form submission langsung juga bisa.
            // Jika ingin pakai fetch, maka harus ambil ID dari button/form-nya.
            return confirm('⚠️ Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.');
        }

        function resetForm() {
            document.querySelector('.search-form').reset();
            // Redirect ke halaman dashboard tanpa parameter search/filter untuk me-refresh
            window.location.href = "{{ route('admin.dashboard') }}";
        }

        function showClaims(laporanId, namaBarang) {
            const modal = document.getElementById('claimsModal');
            const content = document.getElementById('claimsContent');

            // Tampilkan loading
            content.innerHTML = '<div class="loading">Memuat data klaim...</div>';
            
            // Tampilkan modal dengan animasi
            modal.style.display = 'flex'; // Changed to flex for proper centering
            setTimeout(() => {
                modal.classList.add('show');
            }, 10);

            // Fetch data klaim dari API Laravel
            fetch(`/admin/laporan/${laporanId}/claims`) // Pastikan route ini ada di Laravel
                .then(response => {
                    if (!response.ok) {
                        // Jika respons bukan OK, coba baca error message dari server
                        return response.json().then(errorData => {
                            throw new Error(errorData.message || 'Network response was not ok');
                        }).catch(() => {
                            throw new Error('Network response was not ok, and could not parse error message.');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    let html = '';
                    if (data.claims && data.claims.length > 0) {
                        html += `<h3>Klaim untuk: ${namaBarang}</h3>`; // Tambahkan judul di modal
                        data.claims.forEach(claim => {
                            let formattedPhone = '';
                            if (claim.phone) {
                                let rawPhone = claim.phone.replace(/[^0-9]/g, '');
                                if (rawPhone.startsWith('0')) {
                                    formattedPhone = '62' + rawPhone.substring(1);
                                } else if (!rawPhone.startsWith('62') && !rawPhone.startsWith('+62')) {
                                    formattedPhone = '62' + rawPhone;
                                } else {
                                    formattedPhone = rawPhone;
                                }
                            }

                            const messagePengklaim = encodeURIComponent(
                                `Halo *${claim.name}*,\n\nKami dari Tim Lost & Found Telkom University, telah meninjau laporan pengajuan klaim Anda mengenai barang: *${namaBarang}*.` +
                                `\nDeskripsi klaim Anda: "${claim.description}".\n\nMohon konfirmasi kembali apakah anda telah mendapatkan barang tersebut kembali atau belum.` + 
                                '\nKirim pesan Ya(jika sudah diterima) dan Belum(jika belum diterima)'+
                                `\n\nTerima kasih, atas kepercayaan anda menggunakan website LostandFound Salam HEI!`
                            );

                            html += `
                                <div class="claim-item">
                                    <div class="claim-header">
                                        <div class="claim-name">${claim.name}</div>
                                        <div class="claim-date">${claim.created_at}</div>
                                    </div>
                                    <div class="claim-info">
                                        <div>
                                            <label>Email:</label>
                                            <span>${claim.email}</span>
                                        </div>
                                        <div>
                                            <label>No. Telepon:</label>
                                            <span>${claim.phone || 'Tidak tersedia'}</span>
                                        </div>
                                    </div>
                                    <div class="claim-description">
                                        <label>Deskripsi/Alasan Klaim:</label>
                                        <p>${claim.description}</p>
                                    </div>
                                    <div style="margin-top: 15px;">
                                        ${formattedPhone ? `<a href="https://wa.me/${formattedPhone}?text=${messagePengklaim}" target="_blank" class="contact-btn">💬 WhatsApp Pengklaim</a>` : ''}
                                    </div>
                                </div>
                            `;
                        });
                    } else {
                        html = '<div style="text-align: center; padding: 40px; color: #666;"><p>Belum ada klaim untuk barang ini.</p></div>';
                    }
                    content.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                    content.innerHTML = '<div style="text-align: center; padding: 40px; color: #dc3545;"><p>Terjadi kesalahan saat memuat data klaim: ' + error.message + '</p></div>';
                });
        }

        function closeModal() {
            const modal = document.getElementById('claimsModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
                document.getElementById('claimsContent').innerHTML = ''; // Clear content when hidden
            }, 300); // Match transition duration
        }

        window.onclick = function(event) {
            const modal = document.getElementById('claimsModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>
