<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Inventory Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="mb-4">Aplikasi Inventory Barang</h2>

  {!! $message !!}

  <div class="card mb-4">
    <div class="card-header">Form Barang</div>
    <div class="card-body">
      <form method="post" action="/about">
        @csrf
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Kode</label>
            <input type="text" name="kode" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
          </div>
          <div class="col-md-12">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
          </div>
          <div class="col-md-4">
            <label class="form-label">Harga Satuan</label>
            <input type="number" name="harga_satuan" class="form-control" step="0.01" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Foto (URL)</label>
            <input type="text" name="foto" class="form-control">
          </div>
        </div>
        <input type="hidden" name="edit_id">
        <div class="mt-4">
          <button class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-header">Daftar Barang</div>
    <div class="card-body table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Foto</th>
            <th>Waktu Input</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($barangList as $item)
            <tr>
              <td>{{ $item['kode'] }}</td>
              <td>{{ $item['nama_barang'] }}</td>
              <td>{{ $item['deskripsi'] }}</td>
              <td>Rp {{ number_format($item['harga_satuan'], 0, ',', '.') }}</td>
              <td>{{ $item['jumlah'] }}</td>
              <td>
                @if ($item['foto'])
                  <img src="{{ $item['foto'] }}" alt="Foto" width="60">
                @else
                  <em>Tidak ada</em>
                @endif
              </td>
              <td>{{ $item['created_at'] }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
