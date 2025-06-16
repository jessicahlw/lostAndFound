## 📦 Tel-U Lost & Found

Website sederhana untuk membantu mahasiswa Telkom University menemukan kembali barang yang hilang atau tertinggal di lingkungan kampus.

---

### 🎯 Tujuan

Mengurangi barang hilang di kampus dan mempermudah proses pelaporan serta pencarian barang hilang/temuan melalui sistem berbasis web.

---

### 🧩 Fitur Utama

| Fitur                     | Deskripsi                                                                 |
| ------------------------- | ------------------------------------------------------------------------- |
| 📄 Lapor Barang Hilang    | Mahasiswa bisa membuat laporan kehilangan barang.                         |
| 📦 Lapor Barang Ditemukan | Mahasiswa yang menemukan barang bisa melaporkan melalui form khusus.      |
| 🔍 Cari Barang            | Lihat daftar barang hilang/temuan berdasarkan lokasi, tanggal, dan jenis. |
| 📞 Kontak Pelapor         | Info kontak pelapor ditampilkan agar mudah dihubungi.                     |
| 🔐 Login User             | Login untuk kirim/kelola laporan atau klaim barang.                       |
| 🧑‍💻 Admin Panel         | Admin bisa verifikasi laporan, menghapus laporan palsu, dsb.              |
| 🌐 REST API               | API sederhana untuk akses data barang berdasarkan lokasi dan waktu.       |

---

### 🛠️ Teknologi yang Digunakan

* **Laravel** (PHP Framework)
* **HTML & CSS**
* **JavaScript (Opsional)**
* **Git & GitHub** (versi kontrol dan kolaborasi)
* **MySQL** (basis data)

---

### 🚀 Cara Menjalankan Project (Local Development)

1. Clone repository ini:

   ```bash
   git clone https://github.com/jessicahlw/telu-lostnfound.git
   ```

2. Masuk ke folder project:

   ```bash
   cd lostAndFound
   ```

3. Install dependency Laravel:

   ```bash
   composer install
   ```

4. Copy file `.env`:

   ```bash
   cp .env.example .env
   ```

5. Generate app key Laravel:

   ```bash
   php artisan key:generate
   ```

6. Buat database baru di MySQL: `lost_and_found`

7. Edit koneksi database di file `.env`

8. Jalankan migrasi:

   ```bash
   php artisan migrate
   ```

9. Jalankan server:

   ```bash
   php artisan serve
   ```

10. Akses di browser:

    ```
    http://127.0.0.1:8000
    ```

---

### 👥 Tim Pengembang

* Jessica  
* Veronica 
* Laisyawhara
* Ibnu
* Zabila

---

### 📬 Kontak

Kalau ada pertanyaan, ide, atau saran, silakan kirim email ke:
📧jessicadesyanti@gmail.com)
