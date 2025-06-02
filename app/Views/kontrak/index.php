<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Input Kontrak</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #E8EBEA;
      color: #000;
    }
    .sidebar {
      background: linear-gradient(to bottom, #5D56C6, #060334);
      width: 250px;
      min-height: 100vh;
      padding: 20px;
      color: white;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 10px;
      margin: 5px 0;
      border-radius: 5px;
    }
    .sidebar a:hover, .sidebar .active {
      background: rgba(255, 255, 255, 0.2);
    }
    .card-custom {
      background: white;
      color: black;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card-custom:hover {
      transform: translateY(-5px);
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.15);
    }
    .card-custom h4 {
      font-weight: 600;
    }
    .btn-custom, .btn-primary {
      margin: 5px 5px 0 0;
      border-radius: 8px;
    }
    .btn-custom a, .btn-primary a {
      text-decoration: none;
      color: inherit;
    }
    img {
      width: 150px;
    }
  </style>
</head>
<body>
<div class="d-flex">
  <!-- Sidebar -->
  <div class="sidebar">
    <h3 class="text-center">Admin</h3>
    <a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Dashboard</a>
    <a href="<?= base_url('kontrak')?>" class="active"><i class="fa fa-file-contract"></i> Kontrak <i class="fa fa-chevron-down float-end"></i></a>
    <ul class="list-unstyled ps-3">
      <li><a href="<?= base_url('kontrak/e-katalog')?>">• E-Katalog</a></li>
      <li><a href="<?= base_url('kontrak/pl')?>">• PL</a></li>
      <li><a href="<?= base_url('kontrak/tender')?>">• Tender</a></li>
    </ul>
    <a href="<?= base_url('termin') ?>"><i class="fa fa-calendar"></i> Termin</a>
    <img src="<?= base_url('assets/images/logo_white.png') ?>" alt="Logo">
    <a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out-alt"></i> Log out</a>
  </div>

  <!-- Main Content -->
  <div class="container-fluid p-4">
    <h2 class="mb-4"><i class="fa fa-file-contract"></i> Input Kontrak</h2>
    <!-- Informasi Halaman -->
    <p class="text-dark">Silakan pilih metode pengadaan untuk menginput data kontrak atau melihat daftar kontrak yang sudah ada.</p>

    <!-- Statistik Singkat -->
    <div class="alert alert-info text-dark">
      <i class="fa fa-chart-bar"></i> Total kontrak saat ini: 
      <strong>E-Katalog:</strong> <?= count($e_katalog ?? []) ?> | 
      <strong>PL:</strong> <?= count($pl ?? []) ?> | 
      <strong>Tender:</strong> <?= count($tender ?? []) ?>
    </div>
    <div class="row g-4">
      <!-- E-Katalog -->
      <div class="col-md-4">
        <div class="card-custom h-100">
          <h4><i class="fa fa-book"></i> E-Katalog</h4>
          <p>Sistem berisi daftar produk/jasa yang bisa dibeli langsung tanpa tender.</p>
          <div class="d-flex flex-wrap">
            <button class="btn btn-outline-dark btn-custom">
              <a href="<?= base_url('kontrak/e-katalog') ?>"><i class="fa fa-plus-circle"></i> Input</a>
            </button>
            <button class="btn btn-primary btn-custom">
              <a href="<?= base_url('kontrak/e-katalog/daftar_kontrak_e_katalog/') ?>"><i class="fa fa-list"></i> Lihat Kontrak</a>
            </button>
          </div>
        </div>
      </div>

      <!-- Pengadaan Langsung (PL) -->
      <div class="col-md-4">
        <div class="card-custom h-100">
          <h4><i class="fa fa-shopping-cart"></i> Pengadaan Langsung (PL)</h4>
          <p>Metode pengadaan langsung kepada penyedia tanpa proses tender.</p>
          <div class="d-flex flex-wrap">
            <button class="btn btn-outline-dark btn-custom">
              <a href="<?= base_url('kontrak/pl') ?>"><i class="fa fa-plus-circle"></i> Input</a>
            </button>
            <button class="btn btn-primary btn-custom">
              <a href="<?= base_url('kontrak/pl/daftar_kontrak_pl') ?>"><i class="fa fa-list"></i> Lihat Kontrak</a>
            </button>
          </div>
        </div>
      </div>

      <!-- Tender -->
      <div class="col-md-4">
        <div class="card-custom h-100">
          <h4><i class="fa fa-gavel"></i> Tender</h4>
          <p>Seleksi penyedia barang/jasa dengan penawaran terbaik melalui proses lelang.</p>
          <div class="d-flex flex-wrap">
            <button class="btn btn-outline-dark btn-custom">
              <a href="<?= base_url('kontrak/tender') ?>"><i class="fa fa-plus-circle"></i> Input</a>
            </button>
            <button class="btn btn-primary btn-custom">
              <a href="<?= base_url('kontrak/tender/daftar_kontrak_tender/') ?>"><i class="fa fa-list"></i> Lihat Kontrak</a>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
