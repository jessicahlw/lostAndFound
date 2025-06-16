@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f3f4f6;
        padding: 20px;
    }

    form {
        background: white;
        padding: 30px;
        border-radius: 15px;
        max-width: 700px;
        margin: auto;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border: 1px solid #ddd;
    }

    h2 {
        text-align: center;
        color: #800000;
        margin-bottom: 25px;
    }

    label {
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
        color: #800000;
    }

    input[type="text"],
    select,
    textarea,
    input[type="file"] {
        width: 100%;
        padding: 10px 14px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus,
    select:focus,
    textarea:focus,
    input[type="file"]:focus {
        outline: none;
        border-color: #800000;
    }

    textarea {
        resize: vertical;
    }

    input[type="file"]::-webkit-file-upload-button {
        background-color: #800000;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    input[type="file"]::-webkit-file-upload-button:hover {
        background-color: #9A1F1F;
    }

    button[type="submit"],
    .btn-secondary {
        background-color: #800000;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        display: inline-block;
        margin-top: 10px;
        text-decoration: none;
    }

    button[type="submit"]:hover,
    .btn-secondary:hover {
        background-color: #9A1F1F;
    }

    .success {
        background-color: #d1fae5;
        border: 1px solid #10b981;
        color: #065f46;
        padding: 10px 16px;
        border-radius: 6px;
        margin-top: 15px;
    }
</style>

<form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <h2>Edit Barang Temuan</h2>

    @if(session('success'))
        <div class="success">
            <strong>Sukses!</strong> {{ session('success') }}
        </div>
    @endif

    <label for="namaBarang">Nama Barang</label>
    <input type="text" name="namaBarang" value="{{ old('namaBarang', $barang->namaBarang) }}" required>

    <label for="kategoriBarang">Kategori Barang</label>
    <select name="kategoriBarang" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="Elektronik" {{ $barang->kategoriBarang == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
        <option value="Buku" {{ $barang->kategoriBarang == 'Buku' ? 'selected' : '' }}>Buku</option>
        <option value="Barang Pecah Belah" {{ $barang->kategoriBarang == 'Barang Pecah Belah' ? 'selected' : '' }}>Barang Pecah Belah</option>
        <option value="Obat-obatan" {{ $barang->kategoriBarang == 'Obat-obatan' ? 'selected' : '' }}>Obat-obatan</option>
        <option value="Lainnya" {{ $barang->kategoriBarang == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
    </select>

    <label for="lokasiNemu">Lantai</label>
    <select id="lokasiNemu" name="lokasiNemu" required>
        <option value="">-- Pilih Lantai --</option>
        <option value="Lantai 1" {{ $barang->lokasiNemu == 'Lantai 1' ? 'selected' : '' }}>Lantai 1</option>
        <option value="Lantai 2" {{ $barang->lokasiNemu == 'Lantai 2' ? 'selected' : '' }}>Lantai 2</option>
        <option value="Lantai 3" {{ $barang->lokasiNemu == 'Lantai 3' ? 'selected' : '' }}>Lantai 3</option>
        <option value="Lantai 4" {{ $barang->lokasiNemu == 'Lantai 4' ? 'selected' : '' }}>Lantai 4</option>
        <option value="Lantai 5" {{ $barang->lokasiNemu == 'Lantai 5' ? 'selected' : '' }}>Lantai 5</option>
    </select>

    <label for="detailLokasi">Detail Lokasi</label>
    <select id="detailLokasi" name="detailLokasi" data-selected-detail="{{ old('detailLokasi', $barang->detailLokasi) }}">
        <option value="">-- Pilih Detail Lokasi --</option>
    </select>

    <label for="keterangan">Keterangan</label>
<textarea name="keterangan" id="keterangan" class="form-control" rows="4">{{ old('keterangan', $barang->keterangan) }}</textarea>



    <label for="fileFoto">Foto Barang</label>
    <input type="file" name="fileFoto" accept="image/*">
    @if ($barang->fileFoto)
        <p>Foto lama: <img src="{{ asset('data_file/' . $barang->fileFoto) }}?v={{ time() }}" width="100"></p>
    @endif

    <button type="submit">Update Barang</button>
    <a href="{{ route('dashboard.user') }}" class="btn-secondary">Kembali</a>
</form>

<script>
    const subLokasi = {
        'Lantai 1': ['Lobby Student Center','Ruang Rapat','Toilet Lantai 1'],
        'Lantai 2': ['Ruang Dosen','Ruang Rapat', "Toilet Lantai 2"],
        'Lantai 3': ['Kelas 301', 'Kelas 302', 'Kelas 303','Kelas 304', 'Toilet Lantai 3'],
        'Lantai 4': ['Kelas 401', 'Kelas 402', 'Kelas 403', 'Kelas 404', 'Toilet Lantai 4'],
        'Lantai 5': ['Lab 501', 'Lab 502', 'Lab 503', 'Mushola', 'Perpustakaan', 'Toilet Lantai 5']
    };

    const lokasiNemuSelect = document.getElementById('lokasiNemu');
    const detailLokasiSelect = document.getElementById('detailLokasi');
    const selectedDetail = detailLokasiSelect.dataset.selectedDetail; // 🔥 ambil dari data attribute

    function updateDetailOptions() {
        const lantai = lokasiNemuSelect.value;
        const options = subLokasi[lantai] || [];

        detailLokasiSelect.innerHTML = '<option value="">-- Pilih Detail Lokasi --</option>';

        options.forEach(loc => {
            const option = document.createElement('option');
            option.value = loc;
            option.textContent = loc;
            if (loc === selectedDetail) {
                option.selected = true;
            }
            detailLokasiSelect.appendChild(option);
        });
    }

    lokasiNemuSelect.addEventListener('change', updateDetailOptions);
    updateDetailOptions(); // Jalankan saat halaman dimuat
</script>
@endsection