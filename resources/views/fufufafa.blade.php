<!DOCTYPE html>
<html>
<head>
    <title>PHP Native CRUD Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .img-thumbnail {
            width: 60px;
            height: auto;
        }
    </style>
</head>
<body>

<?php
include 'config/database.php';
$data = mysqli_query($conn, "SELECT * FROM crud_barang");
?>

<div class="container mt-5">
    <h2 class="text-center">Daftar Barang</h2>
    <a href="tambah.php" class="btn btn-success mb-3">Tambah Barang</a>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while($d = mysqli_fetch_array($data)) { ?>
            <tr>
                <td><?= $d['kode'] ?></td>
                <td><?= $d['nama_barang'] ?></td>
                <td><?= $d['deskripsi'] ?></td>
                <td>Rp <?= number_format($d['harga_satuan'], 0, ',', '.') ?></td>
                <td><?= $d['jumlah'] ?></td>
                <td><img src="uploads/<?= $d['foto'] ?>" class="img-thumbnail"></td>
                <td>
                    <a href="edit.php?id=<?= $d['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?id=<?= $d['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
