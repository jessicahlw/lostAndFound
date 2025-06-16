<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Barang Temuan</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        form {
            background: white;
            padding: 30px;
            border-radius: 15px;
            max-width: 600px;
            width: 100%;
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
            width: 90%;
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

        button[type="submit"] {
            background-color: #800000;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #9A1F1F;
        }

        .success {
            margin-top: 15px;
            background-color: #d1fae5;
            border: 1px solid #10b981;
            color: #065f46;
            padding: 10px 16px;
            border-radius: 6px;
        }

        .back-button {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #800000;
            font-weight: bold;
            padding: 10px 20px;
            border: 2px solid #800000;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
        }

        .back-button:hover {
            background-color: #800000;
            color: white;
        }
    </style>
</head>
<body>
    <form action="{{ route('upload.proses') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Form Tambah Barang Temuan</h2>

        <label for="namaBarang">Nama Barang</label>
        <input type="text" id="namaBarang" name="namaBarang" required placeholder="Contoh: Flashdisk Sandisk 32GB">

        <label for="kategoriBarang">Kategori Barang</label>
        <select id="kategoriBarang" name="kategoriBarang" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="Elektronik">Elektronik</option>
            <option value="Buku">Buku</option>
            <option value="Pecah Belah">Barang Pecah Belah</option>
            <option value="Obat-obatan">Obat-obatan</option>
            <option value="Lainnya">Lainnya</option>
        </select>

        <label for="lokasiNemu">Lantai</label>
        <select id="lantai" name="lokasiNemu" required>
            <option value="">-- Pilih Lantai --</option>
            <option value="Lantai 1">Lantai 1</option>
            <option value="Lantai 2">Lantai 2</option>
            <option value="Lantai 3">Lantai 3</option>
            <option value="Lantai 4">Lantai 4</option>
            <option value="Lantai 5">Lantai 5</option>
        </select>

        <label for="detailLokasi">Detail Lokasi</label>
        <select id="detailLokasi" name="detailLokasi">
            <option value="">-- Pilih Detail Lokasi --</option>
        </select>

        <label for="keterangan">Keterangan</label>
        <textarea id="keterangan" name="keterangan" rows="3" placeholder="Tambahkan detail seperti warna, merek, kondisi, dsb."></textarea>

        <label for="foto">Upload Foto Barang</label>
        <input type="file" id="fileFoto" name="fileFoto" accept="image/*">

        <button type="submit">Simpan Barang</button>

        <a href="{{ route('dashboard') }}" class="back-button">← Kembali ke Dashboard</a>

        @if (session('success'))
            <div class="success">
                <strong>Sukses!</strong> {{ session('success') }}
            </div>
        @endif
    </form>

    <script>
        const subLokasi = {
            'Lantai 1': ['Lobby Student Center','Ruang Rapat','Toilet Lantai 1'],
            'Lantai 2': ['Ruang Dosen','Ruang Rapat', "Toilet Lantai 2"],
            'Lantai 3': ['Kelas 301', 'Kelas 302', 'Kelas 303','Kelas 304', 'Toilet Lantai 3'],
            'Lantai 4': ['Kelas 401', 'Kelas 402', 'Kelas 403', 'Kelas 404', 'Toilet Lantai 4'],
            'Lantai 5': ['Lab 501', 'Lab 502', 'Lab 503', 'Mushola', 'Perpustakaan', 'Toilet Lantai 5']
        };

        document.getElementById('lantai').addEventListener('change', function () {
            const selectedLantai = this.value;
            const detailDropdown = document.getElementById('detailLokasi');
            detailDropdown.innerHTML = '<option value="">-- Pilih Detail Lokasi --</option>';

            if (subLokasi[selectedLantai]) {
                subLokasi[selectedLantai].forEach(function (lok) {
                    const option = document.createElement('option');
                    option.value = lok;
                    option.text = lok;
                    detailDropdown.add(option);
                });
            }
        });
    </script>
</body>
</html>
