<?php

use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/about', function () {
    $dbFile = base_path('database/barang.db'); // Lokasi database SQLite
    $pdo = new PDO('sqlite:' . $dbFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE TABLE IF NOT EXISTS barang (
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      kode TEXT UNIQUE NOT NULL,
      nama_barang TEXT NOT NULL,
      deskripsi TEXT,
      harga_satuan DECIMAL(15,2) NOT NULL,
      jumlah INTEGER NOT NULL,
      foto TEXT,
      created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
      updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $message = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $kode = trim($_POST['kode'] ?? '');
        $nama = trim($_POST['nama_barang'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');
        $harga = trim($_POST['harga_satuan'] ?? '');
        $jumlah = trim($_POST['jumlah'] ?? '');
        $foto = trim($_POST['foto'] ?? '');
        $edit_id = $_POST['edit_id'] ?? '';

        if ($kode === '' || $nama === '' || $harga === '' || $jumlah === '') {
            $message = '<div class="alert alert-danger">Mohon isi semua field wajib.</div>';
        } else {
            try {
                if ($edit_id) {
                    $stmt = $pdo->prepare("UPDATE barang SET nama_barang = ?, deskripsi = ?, harga_satuan = ?, jumlah = ?, foto = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ? AND kode = ?");
                    $stmt->execute([$nama, $deskripsi, $harga, $jumlah, $foto, $edit_id, $kode]);
                    $message = '<div class="alert alert-success">Barang berhasil diperbarui.</div>';
                } else {
                    $stmt = $pdo->prepare("INSERT INTO barang (kode, nama_barang, deskripsi, harga_satuan, jumlah, foto) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$kode, $nama, $deskripsi, $harga, $jumlah, $foto]);
                    $message = '<div class="alert alert-success">Barang baru berhasil ditambahkan.</div>';
                }
            } catch (PDOException $e) {
                $msg = $e->getMessage();
                if (str_contains($msg, 'UNIQUE')) {
                    $message = '<div class="alert alert-warning">Kode barang sudah digunakan.</div>';
                } else {
                    $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($msg) . '</div>';
                }
            }
        }
    }

    $barangList = $pdo->query("SELECT * FROM barang ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

    return view('about', compact('message', 'barangList'));
});
