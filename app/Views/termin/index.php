<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        h2{
          color: black;
        }
        body {
            background: linear-gradient(to right, #E6F4FF, #95B4E1, #60A0E9);
            color: white;
        }
        .sidebar {
            background: linear-gradient(to bottom, #5D56C6, #060334);
            width: 250px;
            min-height: 100vh;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .sidebar a:hover, .active {
            background: rgba(255, 255, 255, 0.2);
        }
        .dashboard-content {
            padding: 20px;
            background: white;
            color: black;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
        }
        .menu-container {
            display: flex;
            gap: 20px;
        }
        .menu-card {
            background: white;
            color: black;
            padding: 20px;
            border-radius: 8px;
            width: 200px;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .menu-card:hover {
            background: #5D56C6;
            color: white;
        }
        img{
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
        <a href="<?= base_url('kontrak')?>"><i class="fa fa-file-contract"></i> Kontrak <i class="fa fa-chevron-down float-end"></i></a>
        <ul class="list-unstyled ps-3">
            <li><a href="<?= base_url('kontrak/e-katalog')?>">• E-Katalog</a></li>
            <li><a href="<?= base_url('kontrak/pl')?>">• PL</a></li>
            <li><a href="<?= base_url('kontrak/tender')?>">• Tender</a></li>
        </ul>
        <a href="<?= base_url('termin') ?>" class="active"><i class="fa fa-calendar"></i> Termin</a>
        <img src="<?= base_url('assets/images/logo_white.png') ?>" alt="Logo">
        <a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out-alt"></i> Log out</a>
    </div>

    <!-- Main Content - Light Mode -->
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 100vh; background: #f8f9fa;">
  <div class="dashboard-content p-4 rounded shadow w-100" style="max-width: 1000px; background: white;">
    <h2 class="mb-5 text-center text-dark"><i class="fa fa-calendar-alt me-2"></i>Manajemen Termin</h2>

    <div class="row justify-content-center text-center g-4">
      <!-- Data Kontrak -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4" style="cursor: pointer;" onclick="location.href='<?= base_url('data_kontrak') ?>';">
          <i class="fa fa-file-alt fa-2x text-primary mb-3"></i>
          <h5 class="fw-bold">Data Kontrak</h5>
          <p class="text-muted mb-0">Lihat dan kelola seluruh data kontrak.</p>
        </div>
      </div>

      <!-- Daftar Termin -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4" style="cursor: pointer;" onclick="location.href='<?= base_url('input_termin') ?>';">
          <i class="fa fa-tasks fa-2x text-success mb-3"></i>
          <h5 class="fw-bold">Daftar Termin</h5>
          <p class="text-muted mb-0">Input dan atur termin pembayaran.</p>
        </div>
      </div>

      <!-- Laporan Termin -->
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm p-4" style="cursor: pointer;" onclick="location.href='<?= base_url('laporan_termin') ?>';">
          <i class="fa fa-chart-bar fa-2x text-warning mb-3"></i>
          <h5 class="fw-bold">Laporan Termin</h5>
          <p class="text-muted mb-0">Rekap dan visualisasi termin pembayaran.</p>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

</body>
</html>
