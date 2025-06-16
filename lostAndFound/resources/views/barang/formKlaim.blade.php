<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Klaim Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-button {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            background-color: #6c757d;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #5a6268;
        }

        .info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-left: 5px solid #007bff;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Form Klaim Barang</h1>

    <div class="info">
        <h2>{{ $barang->namaBarang }}</h2>
        <p><strong>Kategori:</strong> {{ $barang->kategoriBarang }}</p>
        <p><strong>Lokasi Ditemukan:</strong> {{ $barang->lokasiNemu }}</p>
    </div>

    <form action="{{ route('barang.claim', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="keterangan">Keterangan Klaim:</label>
        <textarea name="keterangan" id="keterangan" rows="4" required></textarea>

        <label for="fotoKlaim">Unggah Foto Bukti Klaim:</label>
        <input type="file" name="fotoKlaim" id="fotoKlaim" accept="image/*" required>

        <button type="submit">Kirim Klaim</button>
    </form>

    <a href="{{ url()->previous() }}" class="back-button">⬅ Kembali</a>
</div>

</body>
</html>
