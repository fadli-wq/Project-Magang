<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontrak</title>
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
        .card-custom {
            background: white;
            color: black;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .btn-custom {
            border: 1px solid black;
            background: transparent;
            color: black;
            padding: 5px 15px;
            border-radius: 5px;
        }
        .btn-custom:hover {
            background: black;
            color: white;
        }
  </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center">Admin</h3>
        <a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Dashboard</a>
        <a href="<?= base_url('e-katalog')?>" class="active"><i class="fa fa-file-contract"></i> Kontrak <i class="fa fa-chevron-down float-end"></i></a>
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
    <h2><i class="fa fa-file-contract"></i> Input Kontrak</h2>
            <div class="card-custom">
                <h4>E-Katalog</h4>
                <p>Sistem ini berisi daftar produk dan jasa yang telah terverifikasi dan tersedia untuk dibeli langsung tanpa melalui proses tender yang panjang.</p>
                <button class="btn btn-custom"><a href="<?= base_url('kontrak/e-katalog')?>" style="color: inherit; text-decoration: none;">INPUT</a></button>
                <button class="btn btn-primary"><a href="<?= base_url('kontrak/e-katalog/daftar_kontrak_e_katalog/')?>" style="color: inherit; text-decoration: none;">Lihat Kontrak</a></button>
            </div>
            <div class="card-custom">
                <h4>Pengadaan Langsung (PL)</h4>
                <p>Metode pengadaan barang/jasa yang dilakukan secara langsung kepada penyedia tanpa melalui proses tender atau lelang.</p>
                <button class="btn btn-custom"><a href="<?= base_url('kontrak/pl')?>" style="color: inherit; text-decoration: none;">INPUT</a></button>
                <button class="btn btn-primary"><a href="<?= base_url('kontrak/pl/daftar_kontrak_pl')?>" style="color: inherit; text-decoration: none;">Lihat Kontrak</a></button>
            </div>
            <div class="card-custom">
                <h4>Tender</h4>
                <p>Proses pelelangan atau seleksi yang dilakukan oleh pemerintah atau perusahaan untuk mendapatkan penyedia barang atau jasa dengan penawaran terbaik.</p>
                <button class="btn btn-custom"><a href="<?= base_url('kontrak/tender')?>" style="color: inherit; text-decoration: none;">INPUT</a></button>
                <button class="btn btn-primary"><a href="<?= base_url('kontrak/tender/daftar_kontrak_tender/')?>" style="color: inherit; text-decoration: none;">Lihat kontrak</a></button>
            </div>
        </div>
    </div>
</div>
</body>
</html>