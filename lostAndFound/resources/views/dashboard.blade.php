<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Lost & Found</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --maroon: #800000;
            --dark-maroon: #660000;
            --light-gray: #f8f9fa; /* Slightly brighter light-gray for a cleaner look */
            --dark-gray: #212529; /* Slightly darker for better contrast */
            --medium-gray: #6c757d; /* Standard medium gray */
            --light-blue: #007bff; /* Primary blue for actions */
            --dark-blue: #0056b3; /* Darker blue for hover */
            --red-danger: #dc3545; /* Standard red for danger */
            --dark-red-danger: #bd2130; /* Darker red for hover */
            --green-success: #d4edda;
            --dark-green-success: #155724;
            --yellow-warning: #fff3cd;
            --dark-yellow-warning: #856404;
            --info-blue: #cce7ff;
            --dark-info-blue: #004085;

            /* New variables for consistency and easier adjustments */
            --border-radius-sm: 8px;
            --border-radius-md: 12px;
            --border-radius-lg: 18px;
            --shadow-sm: 0 4px 8px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 6px 12px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--light-gray);
            color: var(--dark-gray);
            line-height: 1.6; /* Improved readability */
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(to bottom, var(--maroon), var(--dark-maroon)); /* Changed gradient direction for a smoother flow */
            color: white;
            padding: 30px 25px; /* Increased horizontal padding slightly */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: var(--shadow-md); /* Using new shadow variable */
            position: sticky;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            border-right: 1px solid rgba(255, 255, 255, 0.1); /* Subtle border */
        }

        .sidebar h2 {
            font-size: 24px; /* Slightly larger heading */
            margin-bottom: 25px; /* More space below heading */
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3); /* Stronger border for separation */
            padding-bottom: 18px; /* More padding */
            font-weight: 700; /* Bolder heading */
        }

        .sidebar .user-info {
            background: rgba(255, 255, 255, 0.15);
            border-radius: var(--border-radius-md); /* Using new border-radius variable */
            padding: 22px; /* Increased padding */
            margin-bottom: 35px; /* More space below user info */
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.15); /* Slightly stronger inner shadow */
        }

        .sidebar .user-info p {
            margin: 10px 0; /* More vertical space between info lines */
            font-size: 15.5px; /* Slightly larger font size */
            line-height: 1.6;
        }

        .sidebar .user-info p strong {
            font-weight: 600;
        }

        .logout-btn {
            background: white;
            color: var(--maroon);
            border: none;
            padding: 14px 25px; /* Increased padding */
            border-radius: var(--border-radius-md); /* Using new border-radius variable */
            cursor: pointer;
            font-weight: 600;
            margin-top: 40px; /* More space above button */
            width: 100%;
            transition: all 0.3s ease; /* Smoother transition */
            box-shadow: var(--shadow-sm); /* Added subtle shadow */
        }

        .logout-btn:hover {
            background: #f0f0f0;
            transform: translateY(-3px); /* More pronounced lift effect */
            box-shadow: var(--shadow-md); /* Stronger shadow on hover */
        }

        .main {
            flex: 1;
            padding: 40px 50px; /* Increased horizontal padding for more breathing room */
            box-sizing: border-box;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px; /* More space below top bar */
            padding-bottom: 25px; /* More padding below border */
            border-bottom: 1px solid #e9ecef; /* Lighter border color */
        }

        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 30px; /* Increased gap */
        }

        .top-bar h1 {
            margin: 0;
            color: var(--dark-gray);
            font-size: 32px; /* Larger main heading */
            font-weight: 700;
        }

        .button {
            background: var(--maroon);
            color: white;
            padding: 13px 22px; /* Adjusted padding */
            border: none;
            border-radius: var(--border-radius-md); /* Using new border-radius variable */
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm); /* Added subtle shadow */
            gap: 8px; /* Space for potential icon */
        }

        .button:hover {
            background: var(--dark-maroon);
            transform: translateY(-3px); /* More pronounced lift */
            box-shadow: var(--shadow-md); /* Stronger shadow on hover */
        }

        .button.secondary {
            background-color: var(--medium-gray); /* Used medium-gray for secondary button */
            margin-right: 15px; /* Increased margin */
        }

        .button.secondary:hover {
            background-color: var(--dark-gray); /* Darker gray on hover */
        }

        .flash {
            background: var(--green-success);
            color: var(--dark-green-success);
            padding: 18px; /* Increased padding */
            border-radius: var(--border-radius-md); /* Using new border-radius variable */
            margin: 30px 0; /* More vertical margin */
            font-weight: 500;
            text-align: center;
            border: 1px solid rgba(0, 128, 0, 0.25); /* Slightly darker border */
            box-shadow: var(--shadow-sm); /* Consistent shadow */
            font-size: 16px; /* Slightly larger font */
        }

        .laporan {
            margin-top: 50px; /* More space above laporan section */
        }

        .laporan h2 {
            margin-bottom: 30px; /* More space below heading */
            color: var(--dark-gray);
            font-size: 28px; /* Larger heading */
            font-weight: 600;
            border-bottom: 1px solid #dee2e6; /* Lighter border */
            padding-bottom: 15px; /* More padding */
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Wider min-width for cards */
            gap: 30px; /* Increased gap between cards */
        }

        .card {
            background: white;
            border-radius: var(--border-radius-lg); /* Larger border-radius for softer look */
            box-shadow: var(--shadow-md); /* Consistent shadow */
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease; /* Smoother transition */
            border: 1px solid #f0f0f0; /* Very subtle border */
        }

        .card:hover {
            transform: translateY(-8px); /* More pronounced lift */
            box-shadow: var(--shadow-lg); /* Stronger shadow on hover */
        }

        .card img {
            width: 100%;
            height: 220px; /* Slightly increased image height */
            object-fit: cover;
            border-bottom: 1px solid #f0f0f0; /* Consistent subtle border */
        }

        .card-content {
            padding: 25px; /* Increased padding */
            flex: 1;
        }

        .card-content h3 {
            margin-top: 0;
            margin-bottom: 12px; /* More space below title */
            font-size: 22px; /* Slightly larger title */
            font-weight: 600;
            color: var(--dark-gray);
        }

        .card-content p {
            margin: 8px 0; /* More vertical space between info lines */
            font-size: 15px; /* Slightly larger font size */
            color: var(--medium-gray);
        }

        .card-actions {
            padding: 0 25px 25px; /* Consistent padding with content */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .button-wrapper {
            display: flex;
            width: 100%;
            justify-content: space-between;
            gap: 15px;
        }

        .button-edit,
        .button-danger {
            padding: 12px 20px; /* Increased padding for buttons */
            border: none;
            border-radius: var(--border-radius-md); /* Consistent border-radius */
            cursor: pointer;
            text-decoration: none;
            flex: 1;
            text-align: center;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm); /* Consistent shadow */
        }

        .button-edit {
            background: var(--light-blue);
            color: white;
        }

        .button-edit:hover {
            background: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .button-danger {
            background: var(--red-danger);
            color: white;
        }

        .button-danger:hover {
            background: var(--dark-red-danger);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .card-actions form {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .status-badge {
            display: inline-block;
            padding: 7px 14px; /* Increased padding */
            border-radius: 20px; /* More rounded */
            font-size: 13.5px; /* Slightly larger font */
            font-weight: 600;
            margin-top: 15px; /* More space above badge */
            text-transform: capitalize;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08); /* Slightly stronger shadow */
            border: 1px solid rgba(0,0,0,0.05); /* Very subtle border */
        }

        .status-claimed {
            background: var(--green-success);
            color: var(--dark-green-success);
        }

        .status-pending {
            background: var(--yellow-warning);
            color: var(--dark-yellow-warning);
        }

        .status-available {
            background: var(--info-blue);
            color: var(--dark-info-blue);
        }
        
        /* Responsive Adjustments */
        @media (max-width: 1200px) { /* Adjusted breakpoint for better tablet view */
            .sidebar {
                width: 250px;
                padding: 25px 20px;
            }
            .main {
                padding: 35px 40px;
            }
            .top-bar h1 {
                font-size: 28px;
            }
            .grid-container {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); /* Slightly smaller min-width */
                gap: 25px;
            }
        }

        @media (max-width: 992px) { /* Tablet landscape */
            .sidebar {
                width: 220px;
            }
            .main {
                padding: 30px;
            }
            .top-bar h1 {
                font-size: 26px;
            }
            .button {
                padding: 12px 18px;
            }
            .card img {
                height: 180px;
            }
            .card-content {
                padding: 20px;
            }
            .card-content h3 {
                font-size: 20px;
            }
            .card-actions {
                padding: 0 20px 20px;
            }
            .button-edit,
            .button-danger {
                padding: 10px 16px;
            }
        }

        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                height: auto;
                flex-direction: row;
                justify-content: space-around;
                align-items: center; /* Center items vertically in row layout */
                padding: 15px 20px; /* Adjusted padding */
                position: static;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                border-right: none; /* Remove side border */
                border-bottom: 1px solid rgba(255, 255, 255, 0.1); /* Add bottom border */
            }
            .sidebar h2,
            .sidebar .user-info {
                display: none;
            }
            .logout-btn {
                margin-top: 0;
                width: auto;
                padding: 10px 18px; /* Adjusted padding */
                font-size: 15px;
                box-shadow: var(--shadow-sm); /* Ensure consistent shadow */
            }
            .main {
                padding: 25px;
            }
            .top-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px; /* Increased gap */
                margin-bottom: 25px;
            }
            .top-bar-left {
                width: 100%;
                justify-content: space-between;
                gap: 15px;
            }
            .top-bar h1 {
                font-size: 24px;
            }
            .top-bar > div:last-child {
                width: 100%;
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 15px; /* Increased gap */
            }
            .button {
                flex: 1;
                min-width: unset;
                padding: 11px 16px;
                font-size: 14px;
            }
            .button.secondary {
                margin-right: 0;
            }
            .flash {
                margin: 20px 0;
                padding: 14px;
                font-size: 15px;
            }
            .laporan h2 {
                font-size: 22px;
                margin-bottom: 25px;
            }
            .grid-container {
                grid-template-columns: 1fr; /* Single column on tablets */
            }
            .card img {
                height: 200px; /* Maintain a decent image height */
            }
        }

        @media (max-width: 576px) { /* Mobile */
            .main {
                padding: 20px;
            }
            .top-bar {
                align-items: center; /* Center align on smaller screens if it looks better */
                text-align: center; /* Center text if needed */
            }
            .top-bar-left {
                flex-direction: column; /* Stack elements */
                gap: 10px;
            }
            .top-bar h1 {
                font-size: 20px; /* Smaller heading */
            }
            .top-bar > div:last-child {
                flex-direction: column; /* Stack buttons */
                gap: 10px;
            }
            .button {
                width: 100%; /* Full width buttons */
                padding: 10px 15px;
                font-size: 13px;
            }
            .laporan h2 {
                font-size: 20px;
                margin-bottom: 20px;
            }
            .card-content {
                padding: 15px;
            }
            .card-content h3 {
                font-size: 18px;
            }
            .card-actions {
                padding: 0 15px 15px;
            }
            .button-wrapper {
                flex-direction: column; /* Stack action buttons */
                gap: 10px;
            }
            .button-edit,
            .button-danger {
                width: 100%;
                padding: 10px 15px;
                font-size: 14px;
            }
            .status-badge {
                padding: 6px 10px;
                font-size: 12.5px;
            }
        }
    </style>
</head>
<body>
<div class="dashboard">
    <div class="sidebar">
        <div>
            <h2>Profil Kamu</h2>
            <div class="user-info">
                <p><strong>Nama:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Nomor telepon:</strong> {{ $user->phone }}</p>
            </div>
        </div>
        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="main">
        <div class="top-bar">
            <div class="top-bar-left">
                <h1>Lost & Found Dashboard</h1>
            </div>
            <div>
                <a href="{{ route('feed.index') }}" class="button secondary">
                    🌐 Lihat Pusat Laporan
                </a>
                <a href="{{ route('upload.form') }}" class="button">+ Tambah Laporan</a>
            </div>
        </div>

        @if (session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif

        <div class="laporan">
            <h2>Laporan Barang Kamu:</h2>

            @if($laporan->isEmpty())
                <p style="text-align: center; color: var(--medium-gray); padding: 30px; border: 1px dashed #ced4da; border-radius: var(--border-radius-md); margin-top: 30px;">
                    Belum ada laporan barang yang kamu buat. Yuk, buat laporan pertamamu!
                </p>
            @else
                <div class="grid-container">
                    @foreach($laporan as $item)
                        <div class="card">
                            <img src="{{ asset('data_file/' . $item->fileFoto) }}" alt="Foto {{ $item->namaBarang }}">
                            <div class="card-content">
                                <h3>{{ $item->namaBarang }}</h3>
                                <p><strong>Kategori:</strong> {{ $item->kategoriBarang }}</p>
                                <p><strong>Lokasi:</strong> {{ $item->lokasiNemu }}</p>
                                @if ($item->detailLokasi)
                                    <p><strong>Detail:</strong> {{ $item->detailLokasi }}</p>
                                @endif
                                
                                {{-- Status Klaim --}}
                                @if(isset($item->statusKlaim))
                                    @if($item->statusKlaim == 'sudah')
                                        <div class="status-badge status-claimed">✅ Telah Diklaim</div>
                                    @else {{-- Ini akan mencakup 'belum' dan nilai lainnya yang tidak 'sudah' --}}
                                        <div class="status-badge status-available">📢 Belum Diklaim</div>
                                    @endif
                                @else
                                    {{-- Jika kolom statusKlaim tidak ada atau null --}}
                                    <div class="status-badge status-available">📢 Belum Diklaim</div>
                                @endif
                            </div>
                            <div class="card-actions">
                                <div class="button-wrapper">
                                    <a href="{{ route('barang.edit', $item->id) }}" class="button-edit">Edit</a>
                                    <form action="{{ route('barang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus laporan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Tambahan: Barang Terakhir Diedit --}}
        @if(session('barang_terakhir_diedit'))
            @php
                $terakhir = \App\Models\Barang::find(session('barang_terakhir_diedit'));
            @endphp

            @if($terakhir)
                <div class="laporan" style="margin-top: 60px;"> <h2>Barang Terakhir Diedit:</h2>
                    <div class="grid-container">
                        <div class="card">
                            <img src="{{ asset('data_file/' . $terakhir->fileFoto) }}?v={{ time() }}" alt="Foto {{ $terakhir->namaBarang }}">
                            <div class="card-content">
                                <h3>{{ $terakhir->namaBarang }}</h3>
                                <p><strong>Kategori:</strong> {{ $terakhir->kategoriBarang }}</p>
                                <p><strong>Lokasi:</strong> {{ $terakhir->lokasiNemu }}</p>
                                @if ($terakhir->detailLokasi)
                                    <p><strong>Detail:</strong> {{ $terakhir->detailLokasi }}</p>
                                @endif
                                @if(isset($terakhir->statusKlaim))
                                    @if($terakhir->statusKlaim == 'sudah')
                                        <div class="status-badge status-claimed">✅ Telah Diklaim</div>
                                    @else
                                        <div class="status-badge status-available">📢 Belum Diklaim</div>
                                    @endif
                                @else
                                    <div class="status-badge status-available">📢 Belum Diklaim</div>
                                @endif
                                <p style="font-size: 13px; color: #888; margin-top: 15px;"><em>Diperbarui: {{ $terakhir->updated_at->diffForHumans() }}</em></p>
                            </div>
                            <div class="card-actions">
                                <div class="button-wrapper">
                                    <a href="{{ route('barang.edit', $terakhir->id) }}" class="button-edit">Edit</a>
                                    <form action="{{ route('barang.destroy', $terakhir->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus laporan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // No JavaScript for notifications as per previous instruction.
        // Confirmation dialog for delete button
        const deleteForms = document.querySelectorAll('.card-actions form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Yakin ingin hapus laporan ini? Tindakan ini tidak bisa dibatalkan.')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>

</body>
</html>